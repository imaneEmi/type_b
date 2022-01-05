<?php

namespace App\Services\ServicesImpl;

use App\Models\ComiteScientifiqueNonLocal;
use App\Services\ComiteScientifiqueNonLocalService;

class ComiteScientifiqueNonLocalServiceImpl implements ComiteScientifiqueNonLocalService {
    public function findAll(){
        return ComiteScientifiqueNonLocal::all();
    }
    public function findByManifistation($manifestation){
        return ComiteScientifiqueNonLocal::where('manifestation_id',$manifestation->id)->get();
    }

}
