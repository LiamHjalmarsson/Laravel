<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // IMPOORTANT if you do this make sure you know exatly whats going into the database and have it setup correctly 
        // Paginator::useBootstrapFive();
        Model::unguard(); // Allowing mass assignemnt and no logger need to requier us to add filleable in 
        // protected $fillable = [
        //     "title", 
        //     "company",
        //     "location",
        //     "email",
        //     "website",
        //     "description",
        //     "tags"
        // ];
    }
}
