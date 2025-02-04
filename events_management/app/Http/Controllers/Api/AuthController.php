<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // User autentication to api
    // specifice need s when worikg with apis 
        // a bit different with apis tah with noraml websites 
    // LARAVEL SANCTUM 


    // revoking tokens 

    // tooken expiration -> sanctum.php exoerantion=null change to seocouns
    // not removed from the database 
    // with sanctum:prune-expired removes expierd runs automatically

    public function login (Request $request) {
        $data = $request->validate(
            [
                "email" => "required",
                "password" => "required",
            ]
        );

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                "email" => ["The provided credentials are incorrect"]
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "email" => ["The provided credentials are incorrect"]
            ]);
        }

        $token = $user->createToken("api-token")->plainTextToken;

        return response()->json(
            [
                "token" => $token,
            ]
        );
    }    

    public function logout (Request $request) { 
        $request->user()->tokens()->delete();

        return response()->json([
            "message" => "You have been logged out successfully"
        ]);
    }
}

// AuthServiceProvider 


// Policys are a way to organize autorization logic around a particular model or recourse 
// Whereas Gates are used for simple application wide authorization checks

// policies are classes that are created and gates are defined inside the service provider using the GATE FACADE 

// Policics since there are classes they would a a method for each action and gates are simply closures or callbacks 

// policies are more suitable when you have a complex autorization lgic related to a specifi model 


// CUSTOM Command 


// SCHEDULING APP/Console