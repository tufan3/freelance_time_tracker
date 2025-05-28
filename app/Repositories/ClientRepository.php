<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class ClientRepository
{
    public function index($request)
    {
        try {
            $clients = $request->user()->clients;

            return $clients;
        } catch (\Throwable $th) {
            return [
                'message' => 'Client index failed!',
                'error' => $th->getMessage(),
            ];
        }
    }

    public function store($request)
    {
        try {
            $client = new Client();
            $client->user_id = auth()->user()->id;
            $client->name = $request->name;
            $client->email = $request->email;
            $client->contact_person = $request->contact_person;
            $client->save();

            return $client;
        } catch (\Throwable $th) {
            return [
                'message' => 'Client store failed!'
            ];
        }
    }

    public function show($client)
    {
        try {
            $client = Client::find($client);
            return $client;
        } catch (\Throwable $th) {
            return [
                'message' => 'Client show failed!'
            ];
        }
    }

    public function update($request, $client)
    {
        try {
            $client->user_id = auth()->user()->id;
            $client->name = $request->name;
            $client->email = $request->email;
            $client->contact_person = $request->contact_person;
            $client->save();
            return $client;
        } catch (\Throwable $th) {
            return [
                'message' => 'Client update failed!'
            ];
        }
    }

    public function destroy($client)
    {
        try {
            $client->delete();
            return $client;
        } catch (\Throwable $th) {
            return [
                'message' => 'Client destroy failed!'
            ];
        }
    }
}
