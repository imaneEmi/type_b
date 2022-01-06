<?php

namespace App\Services;

interface ManifestationEtablissementService{
    public function findById($id);
    public function findEtablissementsByManifistation($manifestation);
}
