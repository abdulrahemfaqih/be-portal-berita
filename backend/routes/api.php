<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;

Route::middleware(["auth:sanctum"])->group(function () {
    Route::get("/logout", [AuthenticationController::class, "logout"]);
    Route::get("/profile", [AuthenticationController::class, "profile"]);
    // route postingan
    Route::post("/posts", [PostController::class, "store"]);
    Route::post("/posts/{id}", [PostController::class, "update"])->middleware("check.post.ownership");
    Route::delete("/posts/{id}", [PostController::class, "destroy"])->middleware("check.post.ownership");
    // route comment
    Route::post("/comment", [CommentController::class, "store"]);
    Route::patch("/comment/{id}", [CommentController::class, "update"])->middleware("check.comment.ownership");
    Route::delete("/comment/{id}", [CommentController::class, "destroy"])->middleware("check.comment.ownership");
});
Route::post("/register", [AuthenticationController::class, "register"]);
Route::post("/login", [AuthenticationController::class, "login"]);
Route::get("/posts", [PostController::class, "index"]);
Route::get("/posts/{id}", [PostController::class, "show"]);
