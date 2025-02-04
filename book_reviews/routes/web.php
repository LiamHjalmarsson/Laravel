<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return redirect('books');
    return redirect()->route("books.index");
});

// rcourse controller gives us the standardized namin conventions check php artisan route:list
// Folllow the conventions for the curd operations and its easier to understand the purpose of each method and each controller
// Other benefit is the automativ route registraion 
// resource controllers support nested routes 
Route::resource("books", BookController::class)
    ->only(["index", "show"]);

// Route::resource("books.reviews", ReviewController::class)
//     ->scoped(["review", "book"]) // scope it first so that review is in the scope of the book
//     ->only(["create", "store"]); // the actions that we need wount display any revuews specifically have to actions create to display form and store to store data that is being sent 


// open the cache 

Route::resource('books.reviews', ReviewController::class)
    ->scoped(['review' => 'book'])
    ->only(['create', 'store']);