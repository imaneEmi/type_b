<?php

namespace App\Services\ServicesImpl;

use App\Models\BudgetAnnuel;
use App\Services\BudgetAnnuelService;

class BudgetAnnuelServiceImpl implements BudgetAnnuelService
{
    public static function findAll()
    {
        return BudgetAnnuel::all()->sortBy('annee');
    }
}
