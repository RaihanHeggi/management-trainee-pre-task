<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        // function to accessing login page index
        return view('Login.login_ui');
    }

    public function authenticate(Request $request){
        // Validate Login input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Authentication Attempt
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
 
            return redirect()->intended('/dashboard');
        }

        //Authentication Error
        return back()->with('error', 'Terjadi Kesalahan Authentikasi');
    }

    public function logout(){
        Auth::logout();
 
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
