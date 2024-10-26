<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\UpdateInformationRequest;
use App\Http\Requests\Account\UpdatePasswordRequest;
use App\Http\Requests\Account\UpdateEmailRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('throttle:6,1', only: [
                'updatePassword',
                'updateEmail'
            ])
        ];
    }

    /**
     * @OA\Get(
     *     path="/api/account",
     *     tags={"Account"},
     *     summary="Get account information",
     *     description="Retrieve the logged-in user's account information",
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of account information",
     *         @OA\JsonContent(ref="#/components/schemas/User")),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized account"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{"Bearer": {}}}
     * )
     */
    public function getAccountInformation()
    {
        $this->authorize('getAccountInformation', User::class);

        $user = Auth::user();
        $data = $user;

        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/account/update-information",
     *     tags={"Account"},
     *     summary="Update account information",
     *     description="Update the user's account information",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateInformationRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Account information updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized action"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{"Bearer": {}}}
     * )
     */
    public function updateInformation(UpdateInformationRequest $request)
    {
        $this->authorize('updateInformation', User::class);

        $validatedData = $request->validated();
        $user = $request->user();
        $user->update($validatedData);
        $data = $user;

        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/account/update-password",
     *     tags={"Account"},
     *     summary="Update user password",
     *     description="Update the user's password",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdatePasswordRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")),
     *     @OA\Response(
     *         response=400,
     *         description="Current password is incorrect or validation error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized action"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{"Bearer": {}}}
     * )
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $this->authorize('updatePassword', User::class);

        $validatedData = $request->validated();
        $user = $request->user();

        if (!Hash::check($validatedData['current_password'], $user->password)) {
            abort(400, 'Current password is incorrect');
        }

        $user->update(['password' => $validatedData['new_password']]);

        $data = $user;
        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/account/update-email",
     *     tags={"Account"},
     *     summary="Update user email",
     *     description="Update the user's email address",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateEmailRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Email updated successfully, verification sent",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Check your email for verification"),
     *             @OA\Property(property="user", ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Password is incorrect or validation error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized action"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     ),
     *     security={{"Bearer": {}}}
     * )
     */
    public function updateEmail(UpdateEmailRequest $request)
    {
        $this->authorize('updateEmail', User::class);

        $validatedData = $request->validated();
        $user = $request->user();

        if (!Hash::check($validatedData['password'], $user->password)) {
            abort(400, 'Password is incorrect');
        }

        DB::transaction(function () use ($user, $validatedData) {
            $user->email = $validatedData['new_email'];
            $user->email_verified_at = null;
            $user->save();
        });

        $user->sendEmailVerificationNotification();

        $data = [
            'message' => 'Check your email for verification',
            'user' => $user
        ];

        return response()->json($data, 200);
    }
}
