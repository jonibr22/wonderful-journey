<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('profile.index',[
            'user' => $user
        ]);
    }
    public function update(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'not_regex:/[A-Za-z]/'],
        ]);      
        $user = User::where('id',$request->id)->first();
        if($user != null){
            if($user->email != $request->email){
                $taken = User::where('email',$request->email)->first();
                if($taken != null){
                    return redirect()->route('profile')->with('failed','The email has already been taken');
                }
            }
            User::find($request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return redirect()->route('profile')->with('success','The profile was successfully updated');
        }
        return redirect()->route('profile')->with('failed','User is not found');
    }

}
