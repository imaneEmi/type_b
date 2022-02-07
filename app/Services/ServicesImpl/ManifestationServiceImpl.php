<?php

namespace App\Services\ServicesImpl;

use App\Models\BudgetAnnuel;
use App\Models\ComiteOrganisationLocal;
use App\Models\ComiteOrganisationNonLocal;
use App\Models\ComiteScientifiqueLocal;
use App\Models\ComiteScientifiqueNonLocal;
use App\Models\Manifestation;
use App\Models\ManifestationEtablissement;
use App\Services\ManifestationService;

class ManifestationServiceImpl implements ManifestationService
{
    public  function findAll()
    {
        return Manifestation::all();
    }
    public  function findById($id)
    {
        return Manifestation::findOrFail($id);
    }
    public  function save($manif)
    {
        return Manifestation::create($manif);
    }
    public  function update($manif)
    {
        return $manif->save();
    }
    public  function delete($id)
    {
        $manif = $this->findById($id);
        return $manif->delete();
    }

    public  function getManifestation($id, $demandeService, $chercheurService)
    {
        $frais = FraisCouvetServiceImpl::findAll();
        $demande = $demandeService->findById($id);
        $manifestation = $demande->manifestation;
        $coordonnateur = $chercheurService->findByIdNull($demande->coordonnateur_id);
        $soutienSollicites = $manifestation->soutienSollicite;
        $soutienAccordes = $manifestation->soutienAccorde;
        $budgetRestant = BudgetAnnuel::whereYear('annee', date('Y'))->first();
        $contributeurs = $manifestation->contributeurs;
        $natureContributionParticipant = $manifestation->natureContributionParticipant;
        $contributionParticipants = $manifestation->contributionParticipants()->sum('montant');
        return [
            'demande' => $demande, 'manifestation' => $manifestation, 'coordonnateur' => $coordonnateur, 'soutienSollicite' => $soutienSollicites,
            'soutienAccorde' => $soutienAccordes, 'frais' => $frais,'budgetRestant'=>$budgetRestant,'contributeurs'=>$contributeurs,
            'natureContributionParticipant'=>$natureContributionParticipant,
            'contributionParticipants'=>$contributionParticipants,
        ];
    }

    public  function getManifestationDetails($id, $demandeService, $chercheurService, $etablissementService)
    {
        $details_part1 = $this->getManifestation($id, $demandeService, $chercheurService);

        $manifestation = $details_part1['manifestation'];
        $gestionFinanciere = $manifestation->gestionFinanciere;
        $contributeurs = $manifestation->contributeurs;

        $entiteOrganisatrice = $details_part1['coordonnateur']->laboratoire;
        $manifestationEtablissements = ManifestationEtablissement::where("manifestation_id", $manifestation->id)->get();
        $etablissements = [];
        foreach ($manifestationEtablissements as $manifestationEtablissement) {
            try {
                $etablissements[] = $etablissementService->findById($manifestationEtablissement->etablissement_id);
            } catch (\Throwable $th) {
                $etablissements[] = null;
            }
        }
        $comiteOrganisationsLocal = ComiteOrganisationLocal::where("manifestation_id", $manifestation->id)->get();
        $membresComiteOrganisationsLocal = [];
        foreach ($comiteOrganisationsLocal as $comite) {
            try {
                $membresComiteOrganisationsLocal[] = $chercheurService->findById($comite->id_cher);
            } catch (\Throwable $th) {
                $membresComiteOrganisationsLocal[] = null;
            }
        }
        $comiteOrganisationsNonLocal = ComiteOrganisationNonLocal::where("manifestation_id", $manifestation->id)->get();
        $comiteScientifiqueLocal = ComiteScientifiqueLocal::where("manifestation_id", $manifestation->id)->get();
        $comiteScientifiqueNonLocal = ComiteScientifiqueNonLocal::where("manifestation_id", $manifestation->id)->get();
        $details = array_merge($details_part1, [
            'entiteOrganisatrice' => $entiteOrganisatrice,
            'etablissements' => $etablissements, 'contributeurs' => $contributeurs,
            'gestionFinanciere' => $gestionFinanciere, 'membresComiteOrganisationsLocal' => $membresComiteOrganisationsLocal,
            'comiteOrganisationsNonLocal' => $comiteOrganisationsNonLocal, 'comiteScientifiqueLocal' => $comiteScientifiqueLocal,
            'comiteScientifiqueNonLocal' => $comiteScientifiqueNonLocal
        ]);
        return $details;
    }

    public function findByDemandeId($id)
    {
        return Manifestation::where("demande_id", $id)->first();
    }

    public function editMontant($id){

    }
}
