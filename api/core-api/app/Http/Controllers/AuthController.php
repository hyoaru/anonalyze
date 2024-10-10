<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Authentication\SignInRequest;
use App\Http\Requests\Authentication\SignUpRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', only: [
                'signOut',
                'sendEmailVerification',
            ]),
            new Middleware('throttle:6,1', only: [
                'sendEmailVerification'
            ]),
            new Middleware('signed', only: [
                'verifyEmail'
            ])
        ];
    }

    public function sendEmailVerification(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['data' => ['message' => 'Email verification sent']], 200);
    }

    public function verifyEmail(Request $request) {
        $user = User::findOrFail($request->id);

        if ($user->hasVerifiedEmail()) {
            return response()->json(['data' => ['message' => 'Email is already verified']], 200);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json(['data' => ['message' => 'Email has been verified']], 200);
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

        $data = [
            'data' => [
                'message' => 'Registered successfully. Please check your email for verification.',
                'user' => $user,
                'token' => $token->plainTextToken,
            ]
        ];

        return response()->json($data, 200);
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

        $data = [
            'data' => [
                'user' => $user,
                'token' => $token->plainTextToken,
            ]
        ];

        return response()->json($data, 200);
    }

    public function signOut(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        $data = ['data' => $user];

        return response()->json($data, 200);
    }
}
