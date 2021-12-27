<?php

namespace App\Services\ServicesImpl;

use App\Models\ManifestationContributeur;
use App\Models\ManifestationContributionParticipant;
use App\Models\ManifestationTypeContributeur;
use App\Services\ManifestationContributeurService;
use App\Services\ManifestationContributionParticipantService;
use App\Services\ManifestationTypeContributeurService;

class ManifestationTypeContributeurServiceImpl implements ManifestationTypeContributeurService {
    public function findAll(){
        return ManifestationTypeContributeur::all();
    }
    public function findByManifistation($manifestation){
        return ManifestationTypeContributeur::where('manifestation_id',$manifestation->id)->with('typeContributeur')->get();
    }

}
