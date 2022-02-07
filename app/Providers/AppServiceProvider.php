<?php

namespace App\Providers;

use App\Services\ChercheurService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        $this->app->bind(
            'App\Services\LaboratoireService',
            'App\Services\ServicesImpl\LaboratoireServiceImpl'
        );
        $this->app->bind(
            'App\Services\ManifestationEtablissementService',
            'App\Services\ServicesImpl\ManifestationEtablissementServiceImpl'
        );

        $this->app->bind(
            'App\Services\GestionFinanciereService',
            'App\Services\ServicesImpl\GestionFinanciereServiceImpl'
        );
        $this->app->bind(
            'App\Services\ComiteOrganisationLocalService',
            'App\Services\ServicesImpl\ComiteOrganisationLocalServiceImpl'
        );
        $this->app->bind(
            'App\Services\ComiteOrganisationNonLocalService',
            'App\Services\ServicesImpl\ComiteOrganisationNonLocalServiceImpl'
        );
        $this->app->bind(
            'App\Services\ComiteScientifiqueLocalService',
            'App\Services\ServicesImpl\ComiteScientifiqueLocalServiceImpl'
        );
        $this->app->bind(
            'App\Services\ComiteScientifiqueNonLocalService',
            'App\Services\ServicesImpl\ComiteScientifiqueNonLocalServiceImpl'
        );
        $this->app->bind(
            'App\Services\ManifestationContributionParticipantService',
            'App\Services\ServicesImpl\ManifestationContributionParticipantServiceImpl'
        );
        $this->app->bind(
            'App\Services\ManifestationTypeContributeurService',
            'App\Services\ServicesImpl\ManifestationTypeContributeurServiceImpl'
        );
        $this->app->bind(
            'App\Services\SoutienSolliciteService',
            'App\Services\ServicesImpl\SoutienSolliciteServiceImpl'
        );
        $this->app->bind(
            'App\Services\NatureContributionManifestationService',
            'App\Services\ServicesImpl\NatureContributionManifestationServiceImpl'
        );
        $this->app->bind(
            'App\Services\ConditionGeneraleService',
            'App\Services\ServicesImpl\ConditionGeneraleServiceImpl'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @param ChercheurService $chercheurService
     * @return void
     */
    public function boot(ChercheurService $chercheurService)
    {

        Validator::extendImplicit('email_uca_rech', function ($attribute, $value, $parameters, $validator) use ($chercheurService) {
            return $chercheurService->isExistByEmail($value);
        }, "Cet email n'existe pas dans uca recherche !");
    }
}
