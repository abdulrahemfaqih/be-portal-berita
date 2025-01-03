<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AuthenticationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::middleware(["auth:sanctum"])->group(function () {
    Route::get("/logout", [AuthenticationController::class, "logout"]);
    Route::get("/profile", [AuthenticationController::class, "profile"]);
    Route::post("/posts", [PostController::class, "store"]);
    Route::patch("/posts/{id}", [PostController::class, "update"])->middleware("check.post.ownership");
    Route::delete("/posts/{id}", [PostController::class, "destroy"])->middleware("check.post.ownership");
});

Route::post("/login", [AuthenticationController::class, "login"]);
Route::get("/posts", [PostController::class, "index"]);
Route::get("/posts/{id}", [PostController::class, "show"]);
