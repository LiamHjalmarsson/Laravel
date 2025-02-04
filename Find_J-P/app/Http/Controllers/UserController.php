<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    // show register/create form 
    public function create () {
        return view("users.register");
    }

    // Create new user 
    public function store (Request $request) { 
        $formFileds = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFileds["password"] = bcrypt($formFileds["password"]);

        //Create USer
        $user = User::create($formFileds);

        // Auth helper Login 
        auth()->login($user);

        return redirect("/")->with("message", "User creted and loged in ");
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/")->with("message", "User logged out!");
    }

    // login form 
    public function login () {
        return view("users.login");
    }

    // authenticate user 
    public function authenticate (Request $request) {
        $formFileds = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // method attempt
        if(auth()->attempt($formFileds)) {
            $request->session()->regenerate();

            return redirect("/")->with("message", "You are logged in");
        }

        return back()->withErrors(["email" => "invalid Credentials"])->onlyInput("email");
    }
}
