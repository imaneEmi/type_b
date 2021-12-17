<?php

namespace App\Services\ServicesImpl;

use App\Models\BudgetAnnuel;
use App\Services\BudgetAnnuelService;

class BudgetAnnuelServiceImpl implements BudgetAnnuelService
{
    public   function findAll()
    {
        return BudgetAnnuel::all()->sortBy('annee');
    }

    public  function findBudgetParAnneeAndType($annee, $type)
    {
        return BudgetAnnuel::select($type)->where('annee', $annee)->first()->$type;
    }
    public  function findBudgetParAnnee($annee)
    {
        return BudgetAnnuel::where('annee', $annee)->first();
    }
}
