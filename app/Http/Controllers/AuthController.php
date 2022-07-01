<?php

namespace App\Http\Controllers;

use App\Models\{Setting};
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if(!\Auth::check()){
            return redirect('/login');
        }

        return redirect('/dashboard');
    }

    public function logout()
    {
    	auth()->logout();
    	return redirect('/login');
    }

    public function login()
    {
        if(auth()->user()){
            return redirect('/');
        }

        $setting = Setting::find(1);
    	return view('login', compact('setting'));
    }

    public function auth(Request $request)
    {
    	$loginData = $request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ],
        [
            'email.required' => 'Masukan email terlebih dahulu',
            'password.required' => 'Masukan password terlebih dahulu',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors(['Email atau password yang anda masukan salah!']);
        }

        return redirect('/dashboard')->with('success', 'Login Berhasil!');
    }
}