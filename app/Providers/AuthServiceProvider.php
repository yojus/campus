<?php

namespace App\Providers;

use App\Models\Request;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define('teacher', function (User $user) {
            return isset($user->teacher);
        });

        Gate::define('user', function (User $user) {
            return !(isset($user->teacher));
        });

        Gate::define('message', function (User $user, Request $req) {
            return $user->id === $req->user_id
                || $user->id === $req->classOffer->teacher->user_id;
        });
    }
}
