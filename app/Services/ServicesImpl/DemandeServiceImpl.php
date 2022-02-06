<?php

namespace App\Services\ServicesImpl;

use App\Models\Demande;
use App\Models\DemandeStatus;
use App\Models\Manifestation;
use App\Services\LaboratoireService;
use App\Services\DemandeService;
use App\Services\util\Common;
use Illuminate\Support\Facades\DB;


class DemandeServiceImpl implements DemandeService
{

    public function __construct()
    {
    }

    public function findAll()
    {
        return Demande::all();
    }

    public function getAll($chercheurService)
    {
        $demandes = Demande::with('manifestation')->get();
        $coordonnateurs = [];
        foreach ($demandes as $demande) {
            $coordonnateur = $chercheurService->findByIdNull($demande->coordonnateur_id);
            $coordonnateurs[] = $coordonnateur;
        }
        return ['demandes' => $demandes, 'coordonnateurs' => $coordonnateurs];
    }

    public function findById($id)
    {
        return Demande::findOrFail($id);
    }

    public function save($demande)
    {
        return Demande::create($demande);
    }

    public function update($demande)
    {
        return $demande->save();
    }

    public function changeEtat($id, $etat)
    {
        $demande = $this->findById($id);
        $demande->etat = $etat;
        $demande->save();
        return 1;
    }

    public function delete($id)
    {
        $demande = $this->findById($id);
        return $demande->delete();
    }

    public function findByEtat($etat, $chercheurService)
    {
        $demandes = Demande::whereYear('created_at', date('Y'))->where('etat', $etat)->with('manifestation')->get();
        $coordonnateurs = [];
        foreach ($demandes as $demande) {
            $coordonnateur = $chercheurService->findByIdNull($demande->coordonnateur_id);
            $coordonnateurs[] = $coordonnateur;
        }
        return ['demandes' => $demandes, 'coordonnateurs' => $coordonnateurs];
    }

    public function getNbrDemandesAnneeCour()
    {
        return Demande::whereYear('date_envoie', '=', date(Common::getAnneeActuelle()))->count();
    }

    public function getNbrDemandesParEtatAnneeCour($etat)
    {
        return Demande::where('etat', $etat)->whereYear('date_envoie', '=', date(Common::getAnneeActuelle()))->count();
    }

    public function nbrDemandeParEtablissAnneeCour()
    {

        return DB::table('manifestations')
            ->join('demandes', 'manifestations.demande_id', '=', 'demandes.id')
            ->join('entite_organisatrices', 'manifestations.entite_organisatrice_id', '=', 'entite_organisatrices.id')
            ->join('etablissements', 'entite_organisatrices.etablissement_id', '=', 'etablissements.id')
            ->whereYear('date_envoie', '=', date(Common::getAnneeActuelle()))
            ->where('etat', '=', DemandeStatus::ACCEPTEE)
            ->select('libelle', DB::raw('count(*) as total'))
            ->groupBy('libelle')->get();
    }

    public function countCoordonnateurDemandeByCurrentYear($chercheur)
    {
        return Demande::where("date_envoie", date('Y-m-d '))->orWhere("coordonnateur_id", 'like', '%' . $chercheur->id_cher . '%')->count();
    }

    public function findByCoordonnateurId($id)
    {
        return Demande::where("coordonnateur_id", $id)->get();
    }

    public function isAllRapportLaboratoireExists($chercheur)
    {
        /*$chercheurs = $chercheur->laboratoire->chercheurs;
        foreach ($chercheurs as $chercheur) {
            $demandes = $this->findByCoordonnateurId($chercheur->id_cher);
            foreach ($demandes as $demande) {
                if ($demande->manifestation->file_manifestation_rapport_id == null) {
                    return false;
                }
            }
        }*/
        return true;
    }
}
