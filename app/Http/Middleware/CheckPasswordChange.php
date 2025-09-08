<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sessionKey = 'last_password_change_' . $user->id;
            // Check if the session variable is set and matches the database value
            if (session($sessionKey) !== $user->password_changed_at) {
                Auth::logout();
                return redirect()->route('user.login')->with('error', 'Your session has expired due to a password change.');
            }
        }

        return $next($request);
    }
}
