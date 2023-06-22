<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login',[
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required', 'username',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials,$request->filled('remember'))){
            $request->session()->regenerate();

            if (auth()->user()->role == true) {
                return redirect('/dashboard');
            }

            return redirect()->intended('/home');
        }
        return back()->with('loginError', 'Login gagal!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
