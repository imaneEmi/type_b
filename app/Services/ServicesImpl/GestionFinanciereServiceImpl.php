<?php

namespace App\Services\ServicesImpl;

use App\Models\GestionFinanciere;
use App\Models\ManifestationComite;
use App\Services\GestionFinanciereService;
use App\Services\ManifestationComiteService;

class GestionFinanciereServiceImpl implements GestionFinanciereService {
    public function findAll(){
        return GestionFinanciere::all();
    }
    public function findByManifistation($manifestation){
        return GestionFinanciere::where('manifestation_id',$manifestation->id)->get();
    }

}
