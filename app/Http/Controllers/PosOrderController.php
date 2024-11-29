<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PosOrder;
use App\Models\PosOrderDetail;
use App\Models\PosBook;
use App\Models\PosClient;
use App\Http\Resources\PosOrderResource;

class PosOrderController extends Controller
{
    public function purchase(Request $request)
    {
        $validated = $request->validate([
            'doc_number'        => 'required|string|max:20',
            'doc_type'          => 'required|integer',
            'first_name'         => 'required|string|max:15',
            'last_name'         => 'required|string|max:15',
            'phone'             => 'string|max:9',
            'email'             => 'string|email|max:50',
            'books'             => 'required|array',
            'books.*.book_id'   => 'required|exists:pos_books,book_id',
            'books.*.quantity'  => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $client = PosClient::where('doc_number', $validated['doc_number'])->first();

            if ($client) {
                $client->update([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'phone'     => $validated['phone'],
                    'email'     => $validated['email'],
                ]);
            } else {
                $client = PosClient::create([
                    'doc_type'    => $validated['doc_type'],
                    'doc_number'  => $validated['doc_number'],
                    'first_name'   => $validated['first_name'],
                    'last_name'   => $validated['last_name'],
                    'phone'       => $validated['phone'],
                    'email'       => $validated['email'],
                ]);
            }

            $total = 0;

            foreach ($validated['books'] as $book) {
                $bookData = PosBook::findOrFail($book['book_id']);
                $subtotal = $bookData->current_price * $book['quantity'];
                $total += $subtotal;

                if ($bookData->stock < $book['quantity']) {
                    return response()->json([
                        'message' => "No hay suficiente stock para el libro: {$bookData->name}",
                    ], 400);
                }
            }

            $order = PosOrder::create([
                'client_id'  => $client->client_id,
                'total'      => $total,
                'doc_type'   => $validated['doc_type'],
                'doc_number' => $validated['doc_number'],
            ]);

            foreach ($validated['books'] as $book) {
                $bookData = PosBook::findOrFail($book['book_id']);

                PosOrderDetail::create([
                    'order_id'     => $order->order_id,
                    'book_id'      => $book['book_id'],
                    'quantity'     => $book['quantity'],
                    'detail_price' => $bookData->current_price,
                ]);

                $bookData->decrement('stock', $book['quantity']);
            }

            DB::commit();

            $order_created = new PosOrderResource($order);

            $response = [
                'data' => $order_created
            ];

            return response()->json($response, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear la orden',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
