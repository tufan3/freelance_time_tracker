<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthRepository
{
    public function register($request)
    {
        try {
            $register = new User();
            $register->name = $request->name;
            $register->email = $request->email;
            $register->password = bcrypt($request->password);
            $register->save();

            $token = $register->createToken('auth_token')->plainTextToken;

            $response = [
                'access_token' => $token,
                'auth_type' => 'Bearer',
                'user' => $register->only(['id', 'name', 'email']),
            ];

            return $response;
        } catch (\Throwable $th) {
            return [
                'message' => 'User registration failed!',
                'error' => $th->getMessage(),
            ];
        }
    }

    public function login($request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            $response = [
                'access_token' => $token,
                'auth_type' => 'Bearer',
                'user' => $user->only(['id', 'name', 'email']),
            ];

            return $response;
        } catch (\Throwable $th) {
            return [
                'message' => 'User login failed!',
                'error' => $th->getMessage(),
            ];
        }
    }

    public function logout($request)
    {
        $token = $request->user()->currentAccessToken();
        $token->delete();
        return [
            'message' => 'Logged out successfully!',
        ];
    }
}
