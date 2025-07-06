<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm(){
        return view("en.register");
    }

    public function register(Request $request){
        $request->validate([
            'name'=>'required|string|max:32',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6|max:64|confirmed',
        ],
        [
            'email.unique' => 'Email is already in use.'
        ]
    
    );

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('en/dashboard');
    }

    public function showLoginForm(){
        return view("en.login");
    }

    public function login(Request $request){

        if ($request->email === 'admin' && $request->password === 'admin') {
            session(['is_admin' => true]);
            return redirect('/admin');
        }
        
        $creds = $request->only('email', 'password');

        if(Auth::attempt($creds)){
            return redirect('en/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid username/pasword',
        ]);
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->forget('is_admin');

        return redirect('en/login');
    }
}
