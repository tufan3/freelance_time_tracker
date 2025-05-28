<?php

namespace App\Http\Controllers\API;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ClientRepository;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index(Request $request)
    {
        $clients = $this->clientRepository->index($request);
        return response()->json([
            'success' => true,
            'message' => 'Clients fetched successfully',
            'clients' => $clients
        ]);
    }

    public function store(ClientRequest $request)
    {
        $client = $this->clientRepository->store($request);

        return response()->json([
            'success' => true,
            'message' => 'Client created successfully',
            'client' => $client
        ], 201);
    }

    public function show(Client $client)
    {
        $client = $this->clientRepository->show($client);

        return response()->json([
            'success' => true,
            'message' => 'Client fetched successfully',
            'client' => $client
        ]);
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client = $this->clientRepository->update($request, $client);

        return response()->json([
            'success' => true,
            'message' => 'Client updated successfully',
            'client' => $client
        ]);
    }

    public function destroy(Client $client)
    {
        $client = $this->clientRepository->destroy($client);

        return response()->json([
            'success' => true,
            'message' => 'Client deleted successfully'
        ]);
    }
}
