<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\UserListRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{

    // public function index ()
    // {
    //     $user = User::all();
    //     return response()->json($user);
    // }

    public function __construct(private AuthService $authService) {
    }

    public function index(UserListRequest $request): JsonResponse
    {
        $users = $this->authService->allUsers();
        return response()->json([
            'message' => 'Users retrieved successfully',
            'data' => $users,
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $this->authService->register($request->validated());
        return response()->json([
            'message' => 'Successfully registered, please verify your email.'
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());

        if (!$result['status']) {
            return response()->json(['message' => $result['message']], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'user' => $result['user'],
            'token' => $result['token'],
        ], 200);
    }

}

