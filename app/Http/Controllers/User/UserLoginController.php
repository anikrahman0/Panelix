<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;

class UserLoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function showLoginForm()
    {
        if (!auth()->check()) {
            return view('layouts.user.auth.login');
        }
        return to_route('user.dashboard');
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }

    public function logout()
    {
        return $this->userService->logout();
    }
}
