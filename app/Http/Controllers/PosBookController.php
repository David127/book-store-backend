<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PosBook;
use App\Http\Resources\PosBookResource;

class PosBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PosBookResource::collection(PosBook::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'isbn'          => 'required|string|max:13|unique:pos_books,isbn',
            'name'          => 'required|string|max:100',
            'stock'         => 'required|integer|min:0',
            'current_price' => 'required|numeric|min:0',
            'image'         => 'required|string',
        ]);
        
        $book = new PosBookResource(PosBook::create($validated));
        
        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = PosBook::find($id);

        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }

        $book_found = new PosBookResource($book);

        return response()->json($book_found, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = PosBook::find($id);

        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }

        $validated = $request->validate([
            'name'          => 'string|max:100',
            'stock'         => 'integer|min:0',
            'current_price' => 'numeric|min:0',
            'image'         => 'string',
        ]);

        $book->update($validated);

        $book_updated = new PosBookResource($book);

        return response()->json($book_updated, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = PosBook::find($id);

        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Libro eliminado con éxito'], 200);
    }
}
