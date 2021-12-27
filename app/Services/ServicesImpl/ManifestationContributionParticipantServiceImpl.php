<?php

namespace App\Services\ServicesImpl;

use App\Models\ManifestationContributeur;
use App\Models\ManifestationContributionParticipant;
use App\Services\ManifestationContributeurService;
use App\Services\ManifestationContributionParticipantService;

class ManifestationContributionParticipantServiceImpl implements ManifestationContributionParticipantService {
    public function findAll(){
        return ManifestationContributionParticipant::all();
    }
    public function findByManifistation($manifestation){
        return ManifestationContributionParticipant::where('manifestation_id',$manifestation->id)->with('contributionParticipant')->get();
    }

}
