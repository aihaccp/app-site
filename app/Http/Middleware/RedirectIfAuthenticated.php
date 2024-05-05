<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                $firstCompany = Company::where("organition_id", $user->id_company)->first();
                session(['uuid' => $firstCompany->uuid]);
                // Redirect to the dashboard with the UUID of the first company
                if ($firstCompany) {
                    return redirect('/dashboard?uuid=' . $firstCompany->uuid);
                } else {
                    // Handle cases where there is no company associated with the user
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }

        return $next($request);
    }
}
