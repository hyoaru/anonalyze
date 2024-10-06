<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Authentication\SignUpRequest as AuthenticationSignUpRequest;

class AuthController extends Controller
{
    public function sign_up(AuthenticationSignUpRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
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

    public function sign_in(Request $request)
    {
        return 'sign-in';
    }

    public function sign_out(Request $request)
    {
        return 'sign-out';
    }
}
