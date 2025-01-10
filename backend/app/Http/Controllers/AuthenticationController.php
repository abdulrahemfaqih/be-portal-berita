<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{

    public function register(RegisterRequest $request) {
        $request->validated();
        $password = $request->password;
        $hashedPassword = Hash::make($password);

        $user = User::create([
            "username" => $request->username,
            "name" => $request->name,
            "email" => $request->email,
            "password" => $hashedPassword
        ]);

        return response()->json([
            "message" => "Registrasi berhasil"
        ], 201);
    }

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
