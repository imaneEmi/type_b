<?php

namespace App\Services\ServicesImpl;

use App\Models\Dto\Chercheur;
use App\Models\Dto\Laboratoire;
use App\Models\FraisCouvert;
use App\Services\ChercheurService;
use App\Services\LaboratoireService;

class ChercheurServiceImpl implements ChercheurService
{
    public  function findAll()
    {
        return Chercheur::all();
    }
    public  function findById($id)
    {
        return Chercheur::findOrFail($id);
    }
    public  function findByEmail($email)
    {
        return Chercheur::where("email",$email)->with('laboratoire')->first();
    }
}
