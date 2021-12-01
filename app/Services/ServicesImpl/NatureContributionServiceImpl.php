<?php

namespace App\Services\ServicesImpl;

use App\Models\NatureContribution;
use App\Services\NatureContributionService;

class NatureContributionServiceImpl implements NatureContributionService{

    public function __construct(){

    }
    public function findAll(){
        return NatureContribution::all();
    }
   
}
