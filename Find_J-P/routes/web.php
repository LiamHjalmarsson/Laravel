<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use Illuminate\Support\Facades\Route; // Namespaces that laravel uses 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// can use any http method take in two things the end point that we want to listen to and then a clousre a function 
// can pass in a request and response object 
Route::get('/', [ListingController::class, "index"]);
// {
    // return view('listings', [
    //     // "heading" => "Latest listings",
    //     "listings" => Listing::all()
    // ]);
// });


// Show create Form 
Route::get("/listings/create", [ListingController::class, "create"])->middleware("auth");
// store listing data 
Route::post("/listings", [ListingController::class, "store"])->middleware("auth");

// Show editg form 
Route::get("/listings/{listing}/edit", [ListingController::class, "edit"])->middleware("auth");

//edit Submit to update 
Route::put("/listings/{listing}", [ListingController::class, "update"])->middleware("auth");

// DELETE LISTING 
Route::delete("/listings/{listing}", [ListingController::class, "delete"])->middleware("auth");


// Show Register/CreateForm
Route::get("/register", [UserController::class, "create"])->middleware("guest");

// Create User 
Route::post("/users", [UserController::class, "store"])->middleware("guest");

// Logout user out 
Route::post("/logout", [UserController::class, "logout"])->middleware("auth");

// Show login form 
Route::get("/login", [UserController::class, "login"])->name("login")->middleware("guest");
// login in user 
Route::post("/users/authenticate", [UserController::class, "authenticate"]);

// Manage Listings 
Route::get("/listings/manage", [ListingController::class, "manage"])->middleware("auth");

// Singel Listining 
// Route::get("/listings/{id}", function ($id) {
// Route::get("/listings/{listing}", function (Listing $listing) {
Route::get("/listings/{listing}", [ListingController::class, "show"]);

    // $listing = Listing::find($id);

    // if ($listing) {
        // return view("listing", [
        //     "listing" => $listing
        // ]);
    // } else {
        // abort("404");
    // }
// });


Route::get("/hello", function () {
    // response helper that can be used to wrapp 
    return response("<h1> H </h1>Hello world", 404) // takes in the content and then the status then can also add headers 
    -> header("Content-Type", "text/plain")
    -> header("foo", "bar"); // Custom header values 
});

// Wildcards is {} will add inside what ever that param is 
// Debugging helper methods dd & ddd
Route::get("/posts/{id}", function($id) {
    // dd($id); // will kill everything and show ddd($id); // Gives more information 

    return response("Post " . $id);
    // add a constraint whre the id zero to 9
})->where("id", "[0-9]+");


Route::get("/search", function (Request $request) { // Request object 
    dd($request->name . " ");
});



// Common Recourse Routes: 
// index - SHow all listings 
// show - show singel listings 
// create - show form to create new listing 
// store - store new listing 
// edit - show form to edit lisitng 
// update update Listingdestrpyu delte listing 