<?php

namespace App\Services\ServicesImpl;

use App\Models\ManifestationComite;
use App\Services\ManifestationComiteService;

class ManifestationComiteServiceImpl implements ManifestationComiteService {
    public function findAll(){
        return ManifestationComite::all();
    }
    public function findByManifistation($manifestation){
        return ManifestationComite::where('manifestation_id',$manifestation->id)->with('comiteOrganisation')->get();
    }
   
}
