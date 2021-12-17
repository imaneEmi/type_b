<?php

namespace App\Services\ServicesImpl;

use App\Models\Demande;
use App\Models\Manifestation;
use App\Services\util\Config;
use App\Services\DemandeService;
use App\Services\util\Common;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Array_;


class DemandeServiceImpl implements DemandeService
{


    public function findAll()
    {
        return Demande::all();
    }
    public function getAll()
    {
        $demandes = Demande::with('coordonnateur', 'manifestation')->get();
        return ['demandes' => $demandes];
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

    public function findByEtat($etat)
    {
        $demandes = Demande::whereYear('created_at', date('Y'))->where('etat', $etat)->with('coordonnateur', 'manifestation')->get();
        return ['demandes' => $demandes];
    }
    public function getNbrDemandesAnneeCour()
    {
        return  Demande::whereYear('date_envoie', '=', date(Common::getAnneeActuelle()))->count();
    }
    public function getNbrDemandesParEtatAnneeCour($etat)
    {
        return Demande::where('etat', $etat)->whereYear('date_envoie', '=', date(Common::getAnneeActuelle()))->count();
    }
    public  function nbrDemandeParEtablissAnneeCour()
    {

        return DB::table('manifestations')

            ->join('demandes', 'manifestations.demande_id', '=', 'demandes.id')
            ->join('entite_organisatrices', 'manifestations.entite_organisatrice_id', '=', 'entite_organisatrices.id')
            ->join('etablissements', 'entite_organisatrices.etablissement_id', '=', 'etablissements.id')
            ->whereYear('date_envoie', '=', date(Common::getAnneeActuelle()))
            ->where('etat', '=', Config::$ACCEPTEE)
            ->select('libelle', DB::raw('count(*) as total'))
            ->groupBy('libelle')->get();
    }

    public function countCoordonnateurDemandeByCurrentYear($user){
       return Demande::where("date_envoie",date('Y-m-d '))->orWhere("coordonnateur_id", 'like', '%'.$user->id. '%')->count();
    }
}
