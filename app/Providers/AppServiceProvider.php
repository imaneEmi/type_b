<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\ManifestationService',
            'App\Services\ServicesImpl\ManifestationServiceImpl'
        );
        $this->app->bind(
            'App\Services\DemandeService',
            'App\Services\ServicesImpl\DemandeServiceImpl'
        );
        $this->app->bind(
            'App\Services\UserService',
            'App\Services\ServicesImpl\UserServiceImpl'
        );
        $this->app->bind(
            'App\Services\PieceDemandeService',
            'App\Services\ServicesImpl\PieceDemandeServiceImpl'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
