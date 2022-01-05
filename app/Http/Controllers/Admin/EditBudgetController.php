<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetAnnuel;
use Illuminate\Http\Request;

class EditBudgetController extends Controller
{
    public function edit()
    {
        return view('admin/edit_budgetFixe');
    }
    public function save(Request $request)
    {

        BudgetAnnuel::create(['annee' => $request->annee, 'budget_fixe' => $request->budget]);
        return view('admin/edit_budgetFixe');
    }
}
