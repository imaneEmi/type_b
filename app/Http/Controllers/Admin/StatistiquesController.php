<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BudgetAnnuelService;
use App\Services\EtablissementService;
use App\Services\LaboratoireService;
use COM;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // dd(Session::get('entiteOrganisatrices'));


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
        Session::put('etab', $etab);
        Session::put('entite', $entite);
        Session::put('annee', (int)$annee);
        Session::put('budgetDemandes', $request->budgetDemandes);
        if ($request->budgetDemandes == "budget") {
            $isBudget = true;
            $result = $this->budgetAnnuelService->searchBudget($etab, $entite, $annee);
        } else  if ($request->budgetDemandes == "demande") {
            $isBudget = false;
            $result = $this->budgetAnnuelService->searchDemande($etab, $entite, $annee);
        }

        //making sure that all the varibales arrived

        return view('admin/statistiques', [

            'isBudget' => $isBudget, 'result' => $result
        ]);
    }
}
