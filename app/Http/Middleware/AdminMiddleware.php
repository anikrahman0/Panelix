<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('admin')->user();
        if(!empty($user) && $user->status==1){
            return $next($request);
        }

        if (empty($user) && $request->is('admin/dashboard')) {
            abort(404);
        }

        return to_route('admin.loginpage')->with('warning','Session expired. Please log in again or contact support for further assistance.');
    }
}
