<?php

namespace App\Services\ServicesImpl;

use App\Models\ComiteOrganisationLocal;
use App\Models\ManifestationEtablissement;
use App\Services\ChercheurService;
use App\Services\ComiteOrganisationLocalService;
use App\Services\EtablissementService;

class ComiteOrganisationLocalServiceImpl implements ComiteOrganisationLocalService
{

    private  $chercheurService;

    public function __construct(ChercheurService $chercheurService)
    {
        $this->chercheurService = $chercheurService;
    }

    public function findById($id)
    {
        return ComiteOrganisationLocal::findOrFail($id);
    }

    public function findChercheursByManifistation($manifestation)
    {

        $comiteOrganisationLocal = ComiteOrganisationLocal::where('manifestation_id', $manifestation->id)->get();

        $chercheurs = [];
        foreach ($comiteOrganisationLocal as $item) {
            $chercheur = $this->chercheurService->findById($item->id_cher);
            array_push($chercheurs, $chercheur);
        }
        return $chercheurs;
    }

}
