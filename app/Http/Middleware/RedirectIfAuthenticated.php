<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
 

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check())
            {
                // Access the authenticated user
                $user = Auth::user();

                // Access the role name using the defined relationship
                $roleName = $user->role->role_name;
                // Check if the user is trying to access the registration page
                $url = '';
                if ($request->routeIs('register')) {
                    return $next($request);
                }
                
                if($roleName === 'itstaff')
                {
                    $url = '/ITStaff/home';
                }
                else if ($roleName === 'binhiprojectcoordinator')
                {
                    $url = '/BINHI_ProjectCoordinator/home';
                }
                else if ($roleName === 'abakaprojectcoordinator')
                {
                    $url = '/ABAKA_ProjectCoordinator/home';
                }
                else if ($roleName === 'agripinayprojectcoordinator')
                {
                    $url = '/AGRIPINAY_ProjectCoordinator/home';
                }
                else if ($roleName === 'akbayprojectcoordinator')
                {
                    $url = '/AKBAY_ProjectCoordinator/home';
                }
                else if ($roleName === 'leadprojectcoordinator')
                {
                    $url = '/LEAD_ProjectCoordinator/home';
                }
                else if ($roleName === 'beneficiary')
                {
                    $url = '/Beneficiary/home';
                }

                return redirect()->intended($url);
            }
        }

        return $next($request);
    }
}
