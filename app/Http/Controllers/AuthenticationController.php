<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->validated();

        $user = User::where("email", $request->email)->first();
        if (!$user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "email" => ["Email atau password salah"]
            ]);
        }

        $token = $user->createToken("user login")->plainTextToken;
        return response()->json([
            "access_token" => $token,
            "token_type" => "Bearer"
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }

    public function profile()
    {
        $user = auth()->user()->load("post");
        return (new ProfileResource($user))
            ->response()
            ->setStatusCode(200);
    }
}
