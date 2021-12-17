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
        $this->app->bind(
            'App\Services\ManifestationComiteService',
            'App\Services\ServicesImpl\ManifestationComiteServiceImpl'
        );
        $this->app->bind(
            'App\Services\ManifestationContributeurService',
            'App\Services\ServicesImpl\ManifestationContributeurServiceImpl'
        );
        $this->app->bind(
            'App\Services\BudgetAnnuelService',
            'App\Services\ServicesImpl\BudgetAnnuelServiceImpl'
        );

        $this->app->bind(
            'App\Services\ChercheurService',
            'App\Services\ServicesImpl\ChercheurServiceImpl'
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
