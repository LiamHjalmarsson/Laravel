<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// apiRecourse differs from recourse method
    // it wont register the routes that are specific for displaying forms 
    // it will only register the routes that are responsible for listing, showing a recourse add directly adding, modifying it without routes for the form
Route::apiResource("events", EventController::class);


Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->middleware("auth:sanctum");

// an event will point at a event
// scope means that this art and recourses are always part of an event 
// this means that if you use the route model binding to get an attendee laravel will automaially load it by looking only for the attendees of a parent event 
// the routes for this controller will have both as parametes the event and attendee check route list 
Route::apiResource("events.attendees", AttendeeController::class)
    // ->scoped(["attendee" => "event"]);
    ->scoped()->except("update"); // removes the update method routeing 