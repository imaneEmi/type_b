<?php

namespace App\Services;

interface NatureContributionManifestationService
{
    public function findAll();
    public function findByManifistation($manifestation);
}
