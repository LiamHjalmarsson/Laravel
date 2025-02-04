<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow (User $user) {
        // Cant follow yourself
        if ($user->id == auth()->user()->id) {
            return back()->with("failure", "Cant follow yourself");
        }

        // Already following 
        $existFollowCheck = Follow::where([["user_id", "=", auth()->user()->id], ["followeduser", "=", $user->id]])->count();
        if ($existFollowCheck) {
            return back()->with("failure", "Already following this user");
        }

        $newFollow = new Follow;
        // Whaterer users is logged in thats whos creating the follow  
        $newFollow->user_id = auth()->user()->id;
        // person thats getting followed
        $newFollow->followeduser = $user->id;

        $newFollow->save();
        return back()->with("success", "User successfully followed");
    }

    public function removeFollow (User $user) {
        Follow::where([["user_id", "=", auth()->user()->id], ["followeduser", "=", $user->id]])->delete();
        return back()->with("success", "User successfully unfollowed");
    }
}
