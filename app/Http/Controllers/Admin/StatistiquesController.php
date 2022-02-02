<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BudgetAnnuelService;
use App\Services\EtablissementService;
use App\Services\LaboratoireService;
use Illuminate\Http\Request;
use Session;

class StatistiquesController extends Controller
{
    // protected $demandeService;
    protected $budgetAnnuelService;

    private EtablissementService $etablissementService;
    protected LaboratoireService $laboratoireService;
    public function __construct(
        BudgetAnnuelService $d,
        EtablissementService $etablissementService,
        LaboratoireService $laboratoireService,


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
        Session::put('annees', $annees);
        Session::put('etablissements', $etablissements);
        Session::put('entiteOrganisatrices', $entiteOrganisatrice);


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
        $etabIsNull = true;
        $anneeIsNull = true;
        $entiteIsNull = true;
        $isBudget = false;
        $isDemande = false;
        Session::put('result', null);

        if ($request->budgetDemandes == "budget") {
            $isBudget = true;
            if ($etab == "all" && $entite == "all" && $annee == "all") {
                Session::put('result', $this->budgetAnnuelService->findBudgetConsommee());
            } else if ($etab != "all" && $entite != "all" && $annee != "all") {
                Session::put('result', $this->budgetAnnuelService->findBudgetConsommeeParEtabParEntiteParAnnee($etab, $entite, $annee));
                $etabIsNull = false;
                $anneeIsNull = false;
                $entiteIsNull = false;
            } else if ($etab == "all" && $entite == "all" && $annee) {
                Session::put('result', $this->budgetAnnuelService->findBudgetConsommeeParAnnee($annee));
                $anneeIsNull = false;
            } else if ($etab  && $entite == "all"  && $annee) {
                Session::put('result', $this->budgetAnnuelService->findBudgetConsommeeParEtabParAnnee($etab, $annee));
                $etabIsNull = false;
                $anneeIsNull = false;
            } else if ($etab && $entite  && $annee == "all") {
                $etabIsNull = false;
                $entiteIsNull = false;
                Session::put('result', $this->budgetAnnuelService->findBudgetConsommeeParEtabParEntite($etab, $entite));
            }
        }
        // dd(Session::get('result'));
        return view('admin/statistiques', [
            'etabIsNull' => $etabIsNull,
            'entiteIsNull' => $entiteIsNull,
            'anneeIsNull' => $anneeIsNull,
            'isBudget' => $isBudget, 'isDemande' => $isDemande
        ]);
    }
}
