<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function doLogin(Request $request){
        $request->validate([
            'email' => ['required','string','email'],
            'password' => ['required','string'],
        ]);
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];
        $remember = (!empty($request->remember)) ? true : false;
        if (Auth::attempt($credential, $remember)) {
            return redirect()->route('home');
        }
        return redirect()->route('login')->with('failed', 'Email or Password is incorrect');
    }
    public function register(){
        return view('auth.register');
    }
    public function doRegister(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'not_regex:/[A-Za-z]/'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);       
        $user = User::where('email',$request->email)->first();
        if($user == null){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => 'user',
                'password' => bcrypt($request->password),
            ]);
            return redirect()->route('login')->with('success','Register Success! You can try login here');
        }
        return redirect()->route('register')->with('failed', 'Email is already used');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
