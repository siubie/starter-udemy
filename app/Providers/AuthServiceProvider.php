<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public static $permissions = [
        //user management
        'index-user' => ['superadmin', 'admin'],
        'show-user' => ['superadmin', 'admin'],
        'create-user' => ['superadmin'],
        'store-user' => ['superadmin'],
        'edit-user' => ['superadmin'],
        'update-user' => ['superadmin'],
        'destroy-user' => ['superadmin'],
    ];
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //setup superadmin bisa semua
        Gate::before(
            function ($user, $ability) {
                if ($user->role === 'superadmin') {
                    return true;
                }
            }
        );

        foreach (self::$permissions as $action => $roles) {
            Gate::define(
                $action,
                function (User $user) use ($roles) {
                    if (in_array($user->role, $roles)) {
                        return true;
                    }
                }
            );
        }
    }
}
