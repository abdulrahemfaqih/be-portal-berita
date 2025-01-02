<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AuthenticationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get("/posts", [PostController::class, "index"])->middleware(["auth:sanctum"]);
Route::get("/posts/{id}", [PostController::class, "show"])->middleware(["auth:sanctum"]);
Route::post("/login", [AuthenticationController::class, "login"]);
Route::get("/logout", [AuthenticationController::class, "logout"])->middleware(["auth:sanctum"]);
Route::get("/profile", [AuthenticationController::class, "profile"])->middleware(["auth:sanctum"]);
