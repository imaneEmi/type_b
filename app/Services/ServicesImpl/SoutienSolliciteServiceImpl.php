<?php

namespace App\Services\ServicesImpl;

use App\Models\SoutienSollicite;
use App\Services\SoutienSolliciteService;

class SoutienSolliciteServiceImpl implements SoutienSolliciteService {
    public function findAll(){
        return SoutienSollicite::all();
    }
    public function findByManifistation($manifestation){
        return SoutienSollicite::where('manifestation_id',$manifestation->id)->with('fraisCouvert')->get();
    }

    public  function  calculateTotal($soutienSollicite){
       $sum =0;
       foreach ($soutienSollicite as $item){
           $sum += $item->montant;
       }
       return $sum;
    }

}
