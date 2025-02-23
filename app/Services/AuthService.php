<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): ?User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['phone'],
            'password' => $data['password'],
        ]);

        return $user;
    }

    public function allUsers()
    {
        return User::all();
    }

    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return [
                'status' => false,
                'message' => 'Invalid credentials',
            ];
        }

        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'status' => true,
            'user' => $user,
            'token' => $token,
        ];
    }
}


