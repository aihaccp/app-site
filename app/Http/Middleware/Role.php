<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {

        if (Auth::check() && Auth::user()->role) {
            $userRole = Auth::user()->role->nome;
            $roleNames = explode(',', $roles);

            foreach ($roleNames as $role) {
                if ($userRole === $role) {
                    return $next($request);
                }
            }
        }

        return abort(403, 'Unauthorized');
    }
}
