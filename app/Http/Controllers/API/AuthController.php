<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Repositories\AuthRepository;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthLoginRequest;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(AuthRegisterRequest $request)
    {

        $response = $this->authRepository->register($request);

        return response()->json(
            [
                'message' => 'User registered successfully!',
                'data' => $response,
            ], 200);
    }

    public function login(AuthLoginRequest $request)
    {
        $response = $this->authRepository->login($request);

        return response()->json(
            [
                'message' => 'User logged in successfully!',
                'data' => $response,
            ], 200);
    }

    public function logout(Request $request)
    {
        $response = $this->authRepository->logout($request);

        return response()->json($response, 200);
    }
}

