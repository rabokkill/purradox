<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin () 
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function showSignup () 
    {
        return view('auth.signup', [
            'title' => 'Signup'
        ]);
    }

    public function login (Request $request) 
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Incorrect credentials! Try again.'
        ]);
    }

    public function logout (Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }

    public function signup (Request $request) 
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('show.login')->with('message', 'Sign up successful!');
    }
}
