<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "email" => "required",
            "password" => "required",
            "name" => "required",
        ]);
    
        User::create($data);

        $credentials = $request->only('email', 'password');

        Auth::attempt($credentials);

        return redirect()->route("jobs.index")->with("success", "Successfully created account and got logged in");
    }
}
