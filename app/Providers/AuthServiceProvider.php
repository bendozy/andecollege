<?php

namespace AndeCollege\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'AndeCollege\Model' => 'AndeCollege\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        $gate->define('update-resource', function ($user, $resource) {
            return $user->id === $resource->user_id;
        });

        $gate->define('update-category', function ($user, $category) {
            return $user->id === $category->user_id;
        });
    }
}
