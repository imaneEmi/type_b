<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DemandeService;
use App\Services\BudgetAnnuelService;
use App\Services\util\Config;
use Carbon\Carbon;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $collection = $this->budgetAnnuelService->findAllWithLimit(4);
        $anneesarray = $collection->pluck('annee');
        $error = 0;
        $budgetsAnnuelsFixes = $collection->pluck('budget_fixe');
        $budgetsAnnuelsRestant = $collection->pluck('budget_restant');
        $annee = Carbon::now()->format('Y');
        $budget_fixe = $this->budgetAnnuelService->findBudgetParAnneeAndType($annee, 'budget_fixe');
        $budget_restant =  $this->budgetAnnuelService->findBudgetParAnneeAndType($annee, 'budget_restant');
        if ($budget_fixe != $budget_restant) {
            $error = 1;
        }
        return view('admin/index', [
            'nbrTotal' => $this->demandeService->getNbrDemandesAnneeCour(),
            'nbrTotalCourant' => $this->demandeService->getNbrDemandesParEtatAnneeCour(Config::$COURANTE),
            'nbrTotalAccepte' => $this->demandeService->getNbrDemandesParEtatAnneeCour(Config::$ACCEPTEE),
            'nbrTotalRefused' => $this->demandeService->getNbrDemandesParEtatAnneeCour(Config::$REFUSEE),
            'budgetsAnnuelsFixes' => $budgetsAnnuelsFixes,
            'annees' => $anneesarray,
            'error' => $error,
            'budgetsAnnuelsRestant' => $budgetsAnnuelsRestant,
            'budgetCourantFixe' => $this->budgetAnnuelService->findBudgetParAnneeAndType($annee, 'budget_fixe'),
            'budgetCourantRestant' => $this->budgetAnnuelService->findBudgetParAnneeAndType($annee, 'budget_restant'),
            'demandesAcceParEtab' => $this->demandeService->nbrDemandeParEtablissAnneeCour()
        ]);
    }
}
