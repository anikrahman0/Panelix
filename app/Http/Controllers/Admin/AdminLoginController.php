<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showAdminLoginForm()
    {
        $user = Auth::guard('admin')->user();
        if (!empty($user)) {
            return redirect()->route('admin.dashboard')->with('success', 'You are successfully logged in!!');
        } else {
            return view('layouts.admin.auth.login');
        }
    }
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email','max:100'],
            'password' => ['required','string','max:100'],
        ]);
        $credentials = $request->only(['email', 'password']);
        $user = AdminUser::where('email', $credentials['email'])->first();
        if ($user) {
            if($user->status!=1){
                return back()->withErrors([ 'email' => 'Your account has been blocked.', ])->onlyInput('email');
            }else{
                if (Auth::guard('admin')->attempt($credentials)) {
                    return to_route('admin.dashboard')->with('success','You are successfully logged in');
                }
            }
        }else{
            return redirect()->route('admin.loginpage')->withErrors(['email' => 'Invalid credentials.']);
        }
        return back()->withErrors([ 'email' => 'The provided credentials do not match our records.', ])->onlyInput('email');
    }

    public function adminLogout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        return redirect()->route('admin.loginpage');
    }
}
