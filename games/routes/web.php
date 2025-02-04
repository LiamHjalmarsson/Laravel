<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Theseb
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("", fn() => to_route('game.index'));

Route::resource("game", GameController::class);;

Route::get("auth/show/{username}", [AuthController::class, "show"]);
Route::resource('auth', AuthController::class)->only("create", "store", "show", "edit", "update", "destroy");
