<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function showRegisterForm(Request $request)
    {
        if(!auth()->check()){
            return view('layouts.user.auth.register');
        }
        return to_route('user.dashboard');
    }
    public function  userRegisterSubmit(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|digits_between:11,20|unique:users,phone',
            'password' => 'required|min:8|confirmed|max:100',
        ]);

        // Your logic to store the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verify_token' => Str::random(60),
            'email_token_expire' => time(),
        ]);

        $user->emailVerificationNotification();

        Auth::login($user);
        return response()->json(['status'=>'success']);
    }
}
