<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Attendee;
use App\Models\Event;
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
        // define some explicit matching between models and policies dont have to do this 
        // ITS only if you want to override the default laravel behavior 

        // BEST TO USE STANDATD / DEFAULT 
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // when we use this gate we are ceratin that the user is authenticated
        Gate::define("update-event", function($user, Event $event) {
            return $user->id === $event->user_id;
        });

            
    // Gates to work with controllers and recourses and gates are often used best for something
    // thats nott tied to a specific database model or a specific recourse model like gates are good for some kind of generic premission checking or simple cases like this 

        Gate::define("delete-attendee", function($user, Event $event, Attendee $attendee) {
            return $user->id === $event->user_id ||  $user->id === $attendee->user_id;
        });
    }
}
