<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAccountController extends Controller
{
    public function register (Request $request) {
        $data = Validator::make($request->all(), [
            "username" => ["required", Rule::unique("users", "username")],
            'email' => ["required", Rule::unique("users", "email")],
            'password' => 'required',
        ]);
    
        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()], 422);
        }
    
        $dataVaildated = $data->validated();
        $dataVaildated["password"] = bcrypt($dataVaildated["password"]);
    
        $user = User::create($dataVaildated);
    
        $token = $user->createToken('authToken')->accessToken;

        return response()->json(["user" => $user, "token" => $token], 201);
    }

    public function login (Request $request) {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return response()->json(['user' => $user, 'token' => $token]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);   
    } 

    public function logout (Request $request) {
        auth()->logout();
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logged out']);
    }

    public function users () {
        $users = User::latest()->get();
        return response()->json($users, 200);
    }

}
