<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\UpdateAccountInformationRequest;
use App\Http\Requests\Account\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware()
    {
        return [new Middleware('auth:sanctum')];
    }

    public function getAccountInformation() {
        $this->authorize('getAccountInformation', User::class);

        $user = Auth::user();
        $data = ['data' => $user];

        return response()->json($data, 200);
    }

    public function updateAccountInformation(UpdateAccountInformationRequest $request)
    {
        $this->authorize('updateAccountInformation', User::class);

        $validatedData = $request->validated();
        $user = $request->user();
        $user->update($validatedData);
        $data = ['data' => $user];
        
        return response()->json($data, 200);
    }

    public function updatePassword(UpdatePasswordRequest $request) {
        $this->authorize('updatePassword', User::class);

        $validatedData = $request->validated();
        $user = $request->user();
        
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            abort(400, 'Current password is incorrect');
        }

        $user->update(['password' => $validatedData['new_password']]);

        $data = ['data' => $user];
        return response()->json($data, 200);
    }

}
