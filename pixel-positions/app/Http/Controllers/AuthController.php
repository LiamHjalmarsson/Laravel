<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("auth.login");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $validatedAttributes = request()->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        $authenticated = Auth::attempt($validatedAttributes);

        if (!$authenticated) {
            throw ValidationException::withMessages([
                "email" => "Sorry, credentials do not match"
            ]);
        }

        request()->session()->regenerate();

        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        return redirect("/");
    }

}
