<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // With this were saying for this model or resource this is the poliy that should be applied 
        Post::class => PostPolicy::class 
        // PostPolicy this spells out who should be able to perform those curd operations for a given resource 

        // How do we leverage that post policy 

        // SINGLE POST blade file
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        // this is where we are free to spell out a gate 

        Gate::define("visitAdminPages", function ($user) {
            // in the function oher job to return true or false 
            return $user->isAdming === 1;
        }); // first a label for the acion then a function 
    }
}
