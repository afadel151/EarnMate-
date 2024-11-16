<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Auth;
use Closure;
use Illuminate\Http\Request;
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
        // return $next($request);
        if (Auth::check() && Admin::where('user_id',Auth::user()->id)->exists()) {
            return $next($request);
        }
        // Redirect non-admin users
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
