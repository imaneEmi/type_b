<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetAnnuel;
use App\Services\BudgetAnnuelService;
use Illuminate\Http\Request;

class EditBudgetController extends Controller
{

    public function edit()
    {
        return view('admin/edit_budgetFixe');
    }
    public function save(Request $request, BudgetAnnuelService $budgetAnnuelService)
    {
        $error = 1;
        $budgetExixts = $budgetAnnuelService->findBudgetParAnnee($request->annee);
        if ($budgetExixts != null) return view('admin/edit_budgetFixe', compact('error'));
        else {
            $error=0;
            $success=true;
            $budgetAnnuelService->save($request->annee,$request->budget);
            return view('admin/edit_budgetFixe', compact('error','success'));
        }
    }
}
