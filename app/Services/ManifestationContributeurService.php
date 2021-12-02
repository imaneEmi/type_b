<?php

namespace App\Services;

interface ManifestationContributeurService{
    public function findAll();
    public function findByManifistation($manifestation);
   
}
