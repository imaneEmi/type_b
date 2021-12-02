<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComiteOrganisation;
use App\Models\Contributeur;
use App\Models\EntiteOrganisatrice;
use App\Models\Etablissement;
use App\Models\FraisCouvert;
use App\Models\Manifestation;
use App\Models\ManifestationComite;
use App\Models\ManifestationContributeur;
use App\Models\NatureContribution;
use App\Models\SoutienSollicite;
use App\Models\TypeContributeur;
use App\Services\DemandeService;
use App\Services\BudgetAnnuelService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $demandeService;
    protected $budgetAnnuelService;
    public function __construct(DemandeService $d, BudgetAnnuelService $b)
    {
        $this->demandeService = $d;
        $this->budgetAnnuelService = $b;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $nbrTotal = $this->demandeService->getNbrDemandes();
        $nbrTotalAccepte =  $this->demandeService->getNbrDemandesAcceptees();
        $nbrTotalRefused =  $this->demandeService->getNbrDemandesRefusees();
        $collection = $this->budgetAnnuelService->findAll();
        $anneesarray = $collection->pluck('annee');
        $budgetsAnnuelsFixes = $collection->pluck('budget_fixe');
        $budgetsAnnuelsRestant = $collection->pluck('budget_restant');
        return view('admin/index', [
            'nbrTotal' => $nbrTotal, 'nbrTotalAccepte' => $nbrTotalAccepte, 'nbrTotalRefused' => $nbrTotalRefused,
            'budgetsAnnuelsFixes' => $budgetsAnnuelsFixes,  'annees' => $anneesarray,
            'budgetsAnnuelsRestant' => $budgetsAnnuelsRestant
        ]);
    }
}
