<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create()
    {
        $this->authorize('create', User::class);
        return view("auth.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            // intended method is usfel for example force someone to be signed in to see a cearin page 
                // not awalys redirected to the main page but to the page yo actually wanted 
            return redirect()->intended("/");
        } else {
            return redirect()->back()->with("error", "Invalid credentials");
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('auth.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validate([
            "password" => "sometimes|required_with:new_password",
            "new_password" => "sometimes|required_with:password",
        ]);

        if (empty($request->password) && empty($request->new_password)) {
            return redirect()->back()->withErrors([
                'password' => 'Filleds cant be empty', 
                "new_password" => "Cant be empety"
            ]);
        }

        $request["password"] = bcrypt($request["new_password"]);

        $user->update($data);

        return redirect()->back()->with('success', 'Successfully updated');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
