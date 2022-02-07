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
    protected  $manifestations;
    protected $soutien_accordes;
    protected $demandes;
    protected $laboratoire;
    protected $etablissement;
    public function __construct()
    {
        $this->manifestations = env('DB_DATABASE') . ".manifestations";
        $this->soutien_accordes = env('DB_DATABASE') . ".soutien_accordes";
        $this->demandes = env('DB_DATABASE') . ".demandes";
        $this->laboratoires  = env('DB_DATABASE2') . ".laboratoire";
        $this->etablissements  = env('DB_DATABASE2') . ".etablissement";
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


        $query = "SELECT " . $this->etablissements . ".nom as nom_etablissement, count(*) as total FROM "
            . $this->laboratoires
            . ", "
            . $this->etablissements
            . ", "
            . $this->demandes
            . ", "

            . $this->manifestations

            . " where etab_id="
            . $this->etablissements . '.id'
            . " and "
            . $this->laboratoire . 'id_labo'
            . "="
            . $this->manifestations . '.entite_organisatrice_id'
            . " and "
            . $this->demandes . '.id'
            . "="
            . $this->manifestations . '.demande_id 
            and year(date_debut)=' . Common::getAnneeActuelle() . " and etat='" . DemandeStatus::ACCEPTEE . "'" . ' group by ' . $this->etablissements . '.nom;';
        $result = DB::select($query);
        // dd($result);
        return $result;
    }

    public function countCoordonnateurDemandeByCurrentYear($chercheur)
    {
        return Demande::where("date_envoie", date('Y-m-d '))->orWhere("coordonnateur_id", 'like', '%' . $chercheur->id_cher . '%')->count();
    }

    public function findByCoordonnateurId($id)
    {
        return Demande::where("coordonnateur_id", $id)->get();
    }
    public function findAllByCoordonnateurIdAndCurrentYear($id)
    {
        return Demande::whereYear('created_at', date('Y'))->where("coordonnateur_id", $id)->get();
    }

    public function isAllRapportLaboratoireExists($chercheur)
    {
        $chercheurs = $chercheur->laboratoire->chercheurs;
        foreach ($chercheurs as $chercheur) {
            $demandes = $this->findByCoordonnateurId($chercheur->id_cher);
            foreach ($demandes as $demande) {
                if ($demande->manifestation->file_manifestation_rapport_id == null) {
                    return false;
                }
            }
        }
        return true;
    }
}
