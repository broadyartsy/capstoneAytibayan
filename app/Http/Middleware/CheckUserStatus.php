<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the user is blacklisted or has an "Inactive" status
        if (auth()->check() && ($user->blacklisted == true || $user->status->status_name === 'Inactive')) {
            auth()->logout();

            toastr()->timeOut(10000)->addError("Your account is either blacklisted or inactive. You're forbidden to login.");

            return redirect()->route('login');
        }

        return $next($request);
    }
}
