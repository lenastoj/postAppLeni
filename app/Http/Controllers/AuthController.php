<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function getSignIn() {
        return view('signin');
    }
    public function getSignup() {
        return view('signup');
    }

    public function signup(Request $request) {
        if(Auth::check()) {
            return redirect('signup')->withErrors('You are already singed up');
        }

        $request->validate([
            'name' => 'required|min:2|max:100|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:255|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $this->signIn($request);

        return redirect('/')->withSuccess('You have signed-in');
    }

    public function signin(Request $request) {
        if(Auth::check()) {
            return redirect('signin')->withErrors('You are already signed in!'); 
        }
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            return redirect()->intended('/')->withSuccess('Signed in');
        }

        return redirect('signin')->withErrors('Invalid credentials!');
    }

    public function signout() {
        Session::flush();
        Auth::logout();

        return Redirect('signin');
    }
}