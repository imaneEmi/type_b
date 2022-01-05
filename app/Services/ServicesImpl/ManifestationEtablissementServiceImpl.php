<?php

namespace App\Services\ServicesImpl;

use App\Models\ManifestationEtablissement;
use App\Services\EtablissementService;
use App\Services\ManifestationEtablissementService;

class ManifestationEtablissementServiceImpl implements ManifestationEtablissementService
{

    private  $etablissementService;

    public function __construct(EtablissementService $etablissementService)
    {
        $this->etablissementService = $etablissementService;
    }

    public function findById($id)
    {
        return ManifestationEtablissement::findOrFail($id);
    }

    public function findEtablissementsByManifistation($manifestation)
    {

        $manifestationEtablissements = ManifestationEtablissement::where('manifestation_id', $manifestation->id)->get();
        $etablissements = [];
        foreach ($manifestationEtablissements as $manifestationEtablissement) {
            $etablissement = $this->etablissementService->findById($manifestationEtablissement->etablissement_id);
            array_push($etablissements, $etablissement);
        }
        return $etablissements;
    }

}
