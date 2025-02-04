<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function loginApi (Request $request) {
        $data = $request->validate(
            [
                "username" => "required",
                "password" => "required",
                ]
            );

            
            // will only return true if the username and password is valid if true we want to return the personal token 
        if (auth()->attempt($data)) {
            // check if username thats is enter matches user accoint in our table 
            // we now have an instace of a user model 
            // $user = User::where("username", $data["username"]);
            $user = User::where("username", $data["username"])->first();
            $token = $user->createToken("ourapptoken")->plainTextToken;

            // the token value proves that i am the user that just successfully gave a correct username and password
            // can send along further request and we just include this token and we should get authorized/premission 
            return $token;
        }

        return "false"; 
    }

    // function for profile profileFollowrs and profileFollowing to getrid of duplicate code 
    // private = can only be called from within this class 
    private function getSharedData ($user) {
        // Qurey for any and all blog posts of the user 
        // In order to query from the user we first need to spell out the relationship between user and blgo posts from the angle of a user
        // $posts = $user->posts()->get();
        $currentlyFollowing = 0;
        
        if (auth()->check()) {
            $currentlyFollow = Follow::where(
                [["user_id", "=", auth()->user()->id], ["followeduser", "=", $user->id]]
            )->count();
        }

        // we can share a varible and it will be availbe in our blade 
        // Give it 2 arguments firt a a label for this property then the data it self
        View::shared("data", [
            "username" => $user->username, 
            "avatar" => $user->avatar, 
            "postCount" => $user->posts()->count(), 
            "currentlyFollowing" => $currentlyFollowing,
        ]); 
    }

    public function profile (User $user) {
        $currentlyFollowing = 0;
        
        if (auth()->check()) {
            $currentlyFollowing = Follow::where([["user_id", "=", auth()->user()->id], ["followeduser", "=", $user->id]])->count();
        }
        return view("profile-posts", [
            "username" => $user->username, 
            "avatar" => $user->avatar, 
            "postCount" => $user->posts()->count(), 
            "currentlyFollowing" => $currentlyFollowing,
            "posts" => $user->posts()->latest()->get(),
            "followerCount" => $user->followers()->count(),
            "followingCount" => $user->followings()->count(),
        ]);
    }

    public function profileFollowers (User $user) {
        $currentlyFollowing = 0;
        
        if (auth()->check()) {
            $currentlyFollowing = Follow::where([["user_id", "=", auth()->user()->id], ["followeduser", "=", $user->id]])->count();
        }

        return view("profile-followers", [
            "username" => $user->username, 
            "avatar" => $user->avatar, 
            "postCount" => $user->posts()->count(), 
            "currentlyFollowing" => $currentlyFollowing,
            "followers" => $user->followers()->latest()->get(),
            "followerCount" => $user->followers()->count(),
            "followingCount" => $user->followings()->count(),
        ]);
    }
    
    public function profileFollowing (User $user) {
        $currentlyFollowing = 0;
        
        if (auth()->check()) {
            $currentlyFollowing = Follow::where([["user_id", "=", auth()->user()->id], ["followeduser", "=", $user->id]])->count();
        }

        return view("profile-following", [
            "username" => $user->username, 
            "avatar" => $user->avatar, 
            "postCount" => $user->posts()->count(), 
            "currentlyFollowing" => $currentlyFollowing,
            "followings" => $user->followings()->latest()->get(),
            "followerCount" => $user->followers()->count(),
            "followingCount" => $user->followings()->count(),
        ]);
    }

    public function addAvatar (Request $request) {
        // $file = $request->file("avatar")->store("public/avatars"); // in store (name) name is the name of the folder to save the image
        // saved in storage -> app -> public 
        // This is not actually available publivly by default 
        // there is a top level public folder all in this is publivly available 7

        // php artisan storage:link link/shotcut/alias 
        $request->validate(
            [
                "avatar" => "required|image|max:3000",
            ]
        );

        $user = auth()->user();

        $filename = $user->id . "-" . uniqid() . ".jpg";

        // composer require intervention/image packade
        // make not going to create a file on our harddrive its going to return the actual raw data that would be saved 
        $imageData = Image::make($request->file("avatar"))->fit(120)->encode("jpg");
        Storage::put("public/avatars/" . $filename, $imageData); // first we give it its path the directory and filename where it should be saved, secound is the data it self
    
        $oldAvatar = $user->avatar;

        $user->avatar = $filename;
        $user->save();

        if ($oldAvatar != "/fallback-avatar.jpg") {
            // delete old avatar replacing the string from storage to public 
            Storage::delete(str_replace("/storage/", "public/", $oldAvatar));
        }

        return back()->with("success", "avatar updated");
    }

    public function manageAvatarForm () {
        return view("manage-avatar");
    }

    public function showCorrectHomepage (Request $request) {
        // returns true or false 
        if ( auth()->check()) {
            return view("homepage-feed", [
                "posts" => auth()->user()->feedPosts()->latest()->paginate(4)
            ]);
        } else {
            return view("homepage");
        }
    }

    public function register (Request $request) {
        $data = $request->validate(
            [
                "username" => ["required", "min:3", "max:30", Rule::unique("users", "username")],
                "email" => "required",
                "password" => ["required", "confirmed"],
            ]
        );

        $data["password"] = bcrypt($data["password"]);

        $user = User::create($data);

        // will send with the cookie session value will logg in 
        auth()->login($user);
        // return response()->json($user);
        return redirect("/")->with("success", "Thank you for registering");
    }

    public function logout (Request $request) {
        // Global auth function 
        auth()->logout();

        return redirect("/")->with("success", "You have logged out");
    }

    public function login (Request $request) {
        $data = $request->validate(
            [
                "loginusername" => "required",
                "loginpassword" => "required",
            ]
        );

        // univeriall function auth no need to import the namespace golbally avaibale 
        // auth() returns an object and then we can look within this object that it returns to call a metthod 
        // auth()->NameOFTHeMethod example attempt

        //  Attempt you can give exampel username and password and then it wil compare the attempt password and username with the values is´n the db
        // if its matched it will return true else false
        if (auth()->attempt(["username" => $data["loginusername"], "password" => $data["loginpassword"]])) {
            
            // This will return an object where we can look within the object that is returned to call a method 
            // method llike regenerate lokk lin appliaction on the console in cookies there will be laravel session 
            // this session will prove to the laravel server that we are the user we just logged in withthi is presistent

            // the browser will send us back the cookie on ever yincoming request in that way the server can trust that that user s how they say they are 
            // with this vlaue in our cookie it is easy to prove that the user is logged in our not 
            $request->session(); 

            // Show a message to the user example when loggin in our out ( FLASH MESSAGE )
            // redirect to this path with this message ( with takes two argumments name for the type of message and the message text )
            return redirect("/")->with("success", "Welcome, you have logged in successfully");
        } else {
            return redirect("/")->with("error", "Login failed");
        }
    }
}

// Migration has to do with the db 
    // A migration is how we create tables and add columns to tables and remove columns from tables 

// A model also has to do with the db 
    // The Model is how we perform CURD operations on the data that lives in those tables ( CURD create read update and delete delet )
    // A model is also how we define relationships 
        // example relationship between a user and a blog post 
        // user can be an auther of the post 
    // A model is like an extraxtion layer it represents those items in the db and it also is where the relationships are define 

// protected fillable in Models is the properties that are allowed to be in an incomin array and were going to use and trust them 
