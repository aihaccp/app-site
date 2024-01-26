<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use App\Policies\PermissionPolicy;
use App\Models\Role;
use App\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('admin', function ($user) {
            return $user->role->nome === 'admin';
        });

        Gate::define('gerente', function ($user) {
            return $user->role->nome === 'gerente';
        });
        Gate::resource('permissions', PermissionPolicy::class);
        Gate::resource('roles', RolePolicy::class);
    }
}
