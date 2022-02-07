<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BudgetAnnuelService;
use App\Services\util\Common;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EditBudgetController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function edit()
    {
        return view('admin/edit_budgetFixe');
    }
    public function save(Request $request, BudgetAnnuelService $budgetAnnuelService)
    {
        $request->validate([
            'annee' => 'numeric|min:0|not_in:0|not_in:0000',
            'budget' => 'required',
        ]);
        $error = 1;
        $budgetExixts = $budgetAnnuelService->findBudgetParAnnee($request->annee);
        if ($budgetExixts != null) return view('admin/edit_budgetFixe', compact('error'));
        else {
            $error = 0;
            $success = true;
            $budgetAnnuelService->save($request->annee, $request->budget);
            return view('admin/edit_budgetFixe', compact('error', 'success'));
        }
    }
    public function update(Request $request, BudgetAnnuelService $budgetAnnuelService)
    {
        $request->validate([
            'budget' => 'required',
        ]);

        $budgetAnnuelService->updateBudgetActuel($request->budget);
        return back()->with('succes', 2);
    }
}
