<?php

namespace App\Services\ServicesImpl;

use App\Models\ManifestationContributeur;
use App\Services\ManifestationContributeurService;

class ManifestationContributeurServiceImpl implements ManifestationContributeurService {
    public function findAll(){
        return ManifestationContributeur::all();
    }
    public function findByManifistation($manifestation){
        return ManifestationContributeur::where('manifestation_id',$manifestation->id)->with('contributeur')->get();
    }
   
}
