<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectNonAdminFromFilament
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, \Closure $next)
    {
        $user = $request->user();
    
        // If user is not logged in, let Filament handle it
        if (!$user) {
            return $next($request);
        }
    
        // If user is logged in but not admin, redirect
        if (!in_array($user->role, ['admin', 'super_admin'])) {
            return redirect()->route('home');
        }
    
        return $next($request);
    }

}
