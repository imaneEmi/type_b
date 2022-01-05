<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BudgetAnnuelService;
use App\Services\DemandeService;
use App\Services\EtablissementService;
use App\Services\LaboratoireService;
use Illuminate\Http\Request;

class StatistiquesController extends Controller
{
    // protected $demandeService;
    protected $budgetAnnuelService;
    private EtablissementService $etablissementService;
    protected LaboratoireService $laboratoireService;
    public function __construct(
        BudgetAnnuelService $d,
        EtablissementService $etablissementService,
        LaboratoireService $laboratoireService
    ) {
        $this->budgetAnnuelService = $d;
        $this->etablissementService  = $etablissementService;
        $this->laboratoireService = $laboratoireService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $annees = $this->budgetAnnuelService->findAllAnnee();
        $etablissements = $this->etablissementService->findAll();
        $entiteOrganisatrice = $this->laboratoireService->findAll();

        return view('admin/statistiques', [
            'annees' => $annees, 'etablissements' => $etablissements,
            'entiteOrganisatrices' => $entiteOrganisatrice
        ]);
    }
    public function search(Request $request)
    {
        $etab = $request->etablissements;
        $entite = $request->structuresScientifiques;
        $annee = $request->annees;
        $result = null;
        $etabIsNull = true;
        $anneeIsNull = true;
        $entiteIsNull = true;
        $isBudget = false;
        $isDemande = false;
        if ($request->budgetDemandes == "budget") {
            $isDemande = true;
            if ($etab == "all" && $entite == "all" && $annee == "all") {
                $result = $this->budgetAnnuelService->findBudgetConsommee();
                dd($result);
            }
            if ($etab && $entite && $annee) {
                $result = $this->budgetAnnuelService->findBudgetConsommeeParEtabParEntiteParAnnee($etab, $entite, $annee);
                $etabIsNull = false;
                $anneeIsNull = false;
                $entiteIsNull = false;
            }
            if ($etab == "all" && $entite == "all" && $annee) {
                $result = $this->budgetAnnuelService->findBudgetConsommeeParAnnee($annee);
                $anneeIsNull = false;
            }
            if ($etab  && $entite == "all"  && $annee) {
                $result = $this->budgetAnnuelService->findBudgetConsommeeParEtabParAnnee($etab, $annee);
                $etabIsNull = false;
                $anneeIsNull = false;
            }
            if ($etab && $entite  && $annee == "all") {
                $etabIsNull = false;
                $entiteIsNull = false;
                $result = $this->budgetAnnuelService->findBudgetConsommeeParEtabParEntite($etab, $entite);
            }
            $isBudget = true;
        }
        dd($result);
        return view('admin/statistiques', [
            'result' => $result, 'etabIsNull' => $etabIsNull,
            'entiteIsNull' => $entiteIsNull,
            'anneeIsNull' => $anneeIsNull,
            'isBudget' => $isBudget,
        ]);
    }
}
