<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\api\UserAccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/register", [UserAccountController::class, "register"]);
Route::post("/login", [UserAccountController::class, "login"]);
Route::post("/login", [UserController::class, "loginApi"]);
Route::post("/logout", [UserAccountController::class, "logout"]);

Route::post("/create-post", [PostController::class, "createApi"])->middleware("auth:sanctum"); // sanctum is laravel offial built in api solution not cookie based but token based 
Route::delete("/delete-post/{post}", [PostController::class, "deleteApi"])->middleware("auth:sanctum", "can:delete,post");
Route::get("/users", [UserAccountController::class, "users"]);
