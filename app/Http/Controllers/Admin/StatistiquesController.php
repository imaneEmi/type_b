<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BudgetAnnuelService;
use App\Services\DemandeService;
use Illuminate\Http\Request;

class StatistiquesController extends Controller
{
    // protected $demandeService;
    protected $budgetAnnuelService;

    public function __construct(BudgetAnnuelService $d)
    {
        $this->demandeService = $d;
        $this->budgetAnnuelService = $d;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $annees = $this->budgetAnnuelService->findAllAnnee();

        return view('admin/statistiques', ['annees' => $annees]);
    }
}
