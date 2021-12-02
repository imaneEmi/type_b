<?php

namespace App\Services\ServicesImpl;

use App\Models\Etablissement;
use App\Services\EtablissementService;

class EtablissementServiceImpl implements EtablissementService{
    public function __construct(){

    }

    public function findAll(){
        return Etablissement::all();
    }
   
}
