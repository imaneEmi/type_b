<?php

namespace App\Services\ServicesImpl;

use App\Models\Dto\Laboratoire;
use App\Models\FraisCouvert;
use App\Services\LaboratoireService;

class LaboratoireServiceImpl implements LaboratoireService
{
    public  function findAll()
    {
        return Laboratoire::all();
    }
    public  function findById($id)
    {
        return Laboratoire::findOrFail($id);
    }
 
}
