<?php

namespace App\Services\ServicesImpl;

use App\Models\ComiteOrganisationNonLocal;
use App\Models\GestionFinanciere;
use App\Services\ComiteOrganisationNonLocalService;

class ComiteOrganisationNonLocalServiceImpl implements ComiteOrganisationNonLocalService {
    public function findAll(){
        return ComiteOrganisationNonLocal::all();
    }
    public function findByManifistation($manifestation){
        return ComiteOrganisationNonLocal::where('manifestation_id',$manifestation->id)->get();
    }

}
