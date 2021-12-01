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
            'App\Services\TypeContributeurService',
            'App\Services\ServicesImpl\TypeContributeurServiceImpl'
        );

        $this->app->bind(
            'App\Services\NatureContributionService',
            'App\Services\ServicesImpl\NatureContributionServiceImpl'
        );
        $this->app->bind(
            'App\Services\EtablissementService',
            'App\Services\ServicesImpl\EtablissementServiceImpl'
        );
        $this->app->bind(
            'App\Services\FraisCouvertService',
            'App\Services\ServicesImpl\FraisCouvetServiceImpl'
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
