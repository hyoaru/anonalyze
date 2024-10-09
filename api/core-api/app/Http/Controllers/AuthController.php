<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Authentication\SignInRequest;
use App\Http\Requests\Authentication\SignUpRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', only: [
                'signOut'
            ])
        ];
    }

    public function signUp(SignUpRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = $user->createToken($user->email);

        $response = [
            'data' => [
                'user' => $user,
                'token' => $token->plainTextToken,
            ]
        ];

        return $response;
    }

    public function signIn(SignInRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return [
                'message' => 'The provided credentials are incorrect',
                'errors' => []
            ];
        }

        $token = $user->createToken($user->email);

        $response = [
            'data' => [
                'user' => $user,
                'token' => $token->plainTextToken,
            ]
        ];

        return $response;
    }

    public function signOut(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return $user;
    }
}
