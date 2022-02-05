<?php

namespace App\Services\ServicesImpl;

use App\Models\ManifestationTypeContributeur;
use App\Models\NatureContributionManifestation;
use App\Services\NatureContributionManifestationService;

class NatureContributionManifestationServiceImpl implements NatureContributionManifestationService
{
    public function findAll()
    {
        return NatureContributionManifestation::all();
    }
    public function findByManifistation($manifestation)
    {
        return NatureContributionManifestation::where('manifestation_id', $manifestation->id)->with('natureContribution')->get();
    }
}
