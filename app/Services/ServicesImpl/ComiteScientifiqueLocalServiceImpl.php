<?php

namespace App\Services\ServicesImpl;

use App\Models\ComiteScientifiqueLocal;
use App\Services\ComiteScientifiqueLocalService;

class ComiteScientifiqueLocalServiceImpl implements ComiteScientifiqueLocalService {
    public function findAll(){
        return ComiteScientifiqueLocal::all();
    }
    public function findByManifistation($manifestation){
        return ComiteScientifiqueLocal::where('manifestation_id',$manifestation->id)->get();
    }

}
