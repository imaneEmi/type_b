<?php

namespace App\Services\ServicesImpl;

use App\Models\ConditionsGenerale;
use App\Services\ConditionGeneraleService;

class ConditionGeneraleServiceImpl implements ConditionGeneraleService
{
    public  function findAll()
    {
        return ConditionsGenerale::all();
    }
}
