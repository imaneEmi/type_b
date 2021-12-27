<?php

namespace App\Services;

interface ManifestationTypeContributeurService{
    public function findAll();
    public function findByManifistation($manifestation);

}
