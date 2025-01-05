<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\ForgotPasswordRequest;
use App\Http\Requests\Authentication\ResetPasswordRequest;
use App\Http\Requests\Authentication\SignInRequest;
use App\Http\Requests\Authentication\SignUpRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
                'sendEmailVerification',
                'forgotPassword',
            ]),
            new Middleware('signed', only: [
                'verifyEmail',
            ]),
        ];
    }

    /**
     * @OA\Post(
     *     path="/api/auth/email/resend-verification",
     *     tags={"Authentication"},
     *     summary="User resend email verification",
     *     description="Send user an email verification",
     *
     *     @OA\Response(
     *         response=200,
     *         description="User signed up successfully",
     *
     *         @OA\JsonContent(
     *
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *              ),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Validation errors"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{ "Bearer":{} }}
     *
     * )
     */
    public function sendEmailVerification(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            abort(400, 'Email is already verified');
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email verification sent'], 200);
    }

    public function verifyEmail(Request $request)
    {
        $user = User::findOrFail($request->id);

        if ($user->hasVerifiedEmail()) {
            abort(400, 'Email is already verified');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        $clientBaseUrl = env('CLIENT_URL');

        return redirect("{$clientBaseUrl}/account");

        return response()->json(['message' => 'Email has been verified'], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/sign-up",
     *     tags={"Authentication"},
     *     summary="User sign-up",
     *     description="Sign up a new user",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/SignUpRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="User signed up successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/SignUpResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Validation errors"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
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
        $user->sendEmailVerificationNotification();

        $data = [
            'message' => 'Registered successfully. Please check your email for verification.',
            'user' => $user,
            'token' => $token->plainTextToken,
        ];

        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/sign-in",
     *     tags={"Authentication"},
     *     summary="User sign-in",
     *     description="Sign in a user",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/SignInRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="User signed in successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/SignInResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Validation errors"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function signIn(SignInRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (! $user || ! Hash::check($validatedData['password'], $user->password)) {
            abort(400, 'The provided credentials are incorrect');
        }

        $token = $user->createToken($user->email);

        $data = [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];

        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/sign-out",
     *     tags={"Authentication"},
     *     summary="Sign out a user",
     *     description="Signs out the authenticated user by invalidating their token.",
     *
     *     @OA\Response(
     *         response=200,
     *         description="User signed out successfully",
     *
     *         @OA\JsonContent(ref="#/components/schemas/SignOutResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     security={{"Bearer": {}}},
     * )
     */
    public function signOut(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        $data = $user;

        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/forgot-password",
     *     tags={"Authentication"},
     *     summary="User send reset password confirmation",
     *     description="Sends a password reset email confirmation to the user",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/ForgotPasswordRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Password reset link sent",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ForgotPasswordResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Validation errors"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::where('email', $validatedData['email'])->first();

        if (! $user->hasVerifiedEmail()) {
            abort(400, 'Email is not verified');
        }

        Password::sendResetLink($user->only('email'));

        return response()->json($user, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/reset-password",
     *     tags={"Authentication"},
     *     summary="User reset password",
     *     description="Resets a user's password",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/ResetPasswordRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Password reset link sent",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ResetPasswordResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Validation errors"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::where('email', $validatedData['email'])->first();

        $status = Password::reset(
            $validatedData,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            $user->tokens()->delete();

            return response()->json($user, 200);
        } else {
            abort(400, 'The provided credentials are incorrect');
        }
    }
}
