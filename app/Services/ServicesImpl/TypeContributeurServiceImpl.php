<?php

namespace App\Services\ServicesImpl;

use App\Models\TypeContributeur;
use App\Services\TypeContributeurService ;

class TypeContributeurServiceImpl implements TypeContributeurService{

    public function __construct(){

    }
    public function findAll(){
        return TypeContributeur::all();
    }
   
}
