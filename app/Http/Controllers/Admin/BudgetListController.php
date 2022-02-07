<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\BudgetAnnuelService;
use Illuminate\Http\Request;

class BudgetListController extends Controller
{


    public function index(BudgetAnnuelService $budgetAnnuelService)
    {

        if (count($budgetAnnuelService->findAll()) == 0) return view('admin.edit_budgetFixe');

        return view('admin/budget_list', ['result' => $budgetAnnuelService->findAll()]);
    }
}
