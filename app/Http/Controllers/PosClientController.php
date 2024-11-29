<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PosClient;
use App\Http\Resources\PosClientResource;

class PosClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PosClientResource::collection(PosClient::all());
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
            'doc_type'   => 'required|integer',
            'doc_number' => 'required|string|max:20|unique:pos_clients,doc_number',
            'first_name'  => 'required|string|max:15',
            'last_name'  => 'required|string|max:15',
            'phone'      => 'string|max:9',
            'email'      => 'string|email|max:50',
        ]);

        $client = PosClient::create($validated);
        $client_created = new PosClientResource($client);

        return response()->json($client_created, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = PosClient::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $client_found = new PosClientResource($client);

        return response()->json($client_found, 200);
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
        $client = PosClient::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $validated = $request->validate([
            'doc_type'   => 'integer',
            'doc_number' => 'string|max:20|unique:pos_clients,doc_number,' . $id . ',client_id',
            'first_name'  => 'string|max:15',
            'last_name'  => 'string|max:15',
            'phone'      => 'string|max:9',
            'email'      => 'string|email|max:50',
        ]);

        $client->update($validated);
        $client_updated = new PosClientResource($client);

        return response()->json($client_updated, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = PosClient::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Cliente eliminado con éxito'], 200);
    }
}
