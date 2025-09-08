<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if($request->user('admin')->is_super != 1){
            if ($request->user('admin')->hasPermission($permission)) {
                return $next($request);
            }
            abort(403, 'Unauthorized');
        }else{
            return $next($request);
        }
    }
}
