<?php

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\FollowController;

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

Route::get("/admin", function () {
    if (Gate::allows("visitAdminPages")) {
        return "ADMIN";
    }

    return "cant view this page";
}); 

Route::get("/admin", function () {
    return "ADMIN";
})->middleware("can:visitAdminPages"); 

// What IS A GATE
// in somways simmilar to a policy but in other ways diffrent
// A policy is tied to a model or a resource, has verbiage like create , read update and delte 
// A gate i simpler and when you just define a single verbiage like admings only, some action that isnt a curd action tied to a model 
// APP > Providers folder > AuthservieProvider 

// Two ways either in the controller or  in the route as a middleware
// Gate simillare to a poicy but the policy is design for curd a Gate is just where spelling out a singel ability 


// Route::get('/', [ExampleController::class, "homepage"]);
Route::get('/', [UserController::class, "showCorrectHomepage"])->name("login");

// The search path followed bye the controller type and its method & function name 
// php artisan make:middleware MustBeLoggedIn
Route::post("/register", [UserController::class, "register"])->middleware("guest");
Route::post("/login", [UserController::class, "login"])->middleware("guest");
Route::post("/logout", [UserController::class, "logout"])->middleware("mustBeLoggedIn");
Route::get("/manage/avatar", [UserController::class, "manageAvatarForm"])->middleware("mustBeLoggedIn");
Route::post("/manage/avatar", [UserController::class, "addAvatar"])->middleware("mustBeLoggedIn");


Route::post("/create-follow/{user:username}", [FollowController::class, "createFollow"])->middleware("mustBeLoggedIn");
Route::post("/remove-follow/{user:username}", [FollowController::class, "removeFollow"])->middleware("mustBeLoggedIn");
// middleware folder redirectifAuth file
Route::get("/create-post", [PostController::class, "showCreateForm"])->middleware("mustBeLoggedIn");
Route::get("/post/{post}", [PostController::class, "showPost"]);
Route::post("/create-post", [PostController::class, "createNewPost"])->middleware("mustBeLoggedIn");

// Route::delete("/post/{post}", [PostController::class, "delete"]); // With condition in the controller
// Only let the user pass through the middleware and get to the actual funcctionality if the current user can delete this post 
Route::delete("/post/{post}", [PostController::class, "delete"])->middleware("can:delete,post"); // with the condtion in the middleware

Route::get("/post/{post}/edit", [PostController::class, "editForm"])->middleware("can:update,post");
Route::put("/post/{post}", [PostController::class, "editUpdate"])->middleware("can:update,post");

// varible user then : colon and then the name or the column that your going to be looking up username/id etc
Route::get("/profile/{user:username}", [UserController::class, "profile"])->middleware("mustBeLoggedIn");
Route::get("/profile/{user:username}/followers", [UserController::class, "profileFollowers"])->middleware("mustBeLoggedIn");
Route::get("/profile/{user:username}/following", [UserController::class, "profileFollowing"])->middleware("mustBeLoggedIn");

Route::get("/search/{term}", [PostController::class, "search"]);


// use :: to call a stati function within the class 
// Route::get("/about", function () {
//     return view('about');
// });
// Route::get("/about", [ExampleController::class, "aboutpage"]);