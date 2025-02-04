<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RegisterController;

Route::get('/', [JobController::class, "index"]);

Route::get('/jobs/create', [JobController::class, "create"])->middleware("auth");
Route::post('/jobs', [JobController::class, "store"])->middleware("auth");

Route::get('/search', SearchController::class); // when only have one __ and us __invoke
Route::get('/tag/{tag:name}', TagController::class); 

Route::middleware("guest")->group(function () {
    Route::get('/register', [RegisterController::class, "create"]);
    Route::post('/register', [RegisterController::class, "store"]);
    
    Route::get('/login', [AuthController::class, "create"]);
    Route::post('/login', [AuthController::class, "store"]);
});

Route::delete('/logout', [AuthController::class, "destroy"])->middleware("auth");
