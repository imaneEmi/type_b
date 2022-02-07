<?php

namespace App\Services\ServicesImpl;

use App\Models\BudgetAnnuel;
use App\Models\DemandeStatus;
use App\Models\Dto\Laboratoire;
use App\Services\BudgetAnnuelService;
use App\Services\util\Common;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BudgetAnnuelServiceImpl implements BudgetAnnuelService
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
    public   function findAll()
    {
        return BudgetAnnuel::all()->sortBy('annee');
    }
    public   function findAllWithLimit($limit)
    {
        return BudgetAnnuel::orderBy('annee', 'desc')->take($limit)->get()->reverse();
    }
    public  function findBudgetParAnneeAndType($annee, $type)
    {
        return BudgetAnnuel::select($type)->where('annee', $annee)->first()->$type;
    }
    public  function findBudgetParAnnee($annee)
    {
        return BudgetAnnuel::where('annee', $annee)->first();
    }
    public  function findAllAnnee()
    {
        return BudgetAnnuel::select('annee')->get();
    }

    public function searchBudget($etablissement, $entite, $annee)
    {

        $query = "SELECT montant,date_debut,etablissement.nom  as nom_etablissement, laboratoire.nom as nom_labo FROM "
            . $this->laboratoires
            . ", "
            . $this->etablissements
            . ", "
            . $this->demandes
            . ", "

            . $this->manifestations
            . ", "
            . $this->soutien_accordes
            . " where etab_id="
            . $this->etablissements . '.id'
            . " and "
            . $this->laboratoire . 'id_labo'
            . "="
            . $this->manifestations . '.entite_organisatrice_id'
            . " and "
            . $this->demandes . '.id'
            . "="
            . $this->manifestations . '.demande_id'
            . " and "
            . $this->soutien_accordes . '.manifestation_id'
            . "="
            . $this->manifestations . '.id'
            . " and "
            . $this->demandes . '.etat' . "=" . "'" . DemandeStatus::ACCEPTEE . "'";

        if ($etablissement != "all" && $entite != "all" && $annee != "all") {

            $query = $query . " and  etab_id=" . $etablissement . " and id_labo=" . $entite . " and year(date_debut)=" . $annee;
        } else if ($entite != "all") {

            $query = $query . " and id_labo=" . $entite;
        } else if ($annee != "all") {
            $query = $query
                . " and year(date_debut)=" . $annee;
        } else if ($etablissement != "all") {
            $query = $query . " and etab_id=" . $etablissement;
        }
        $query = $query
            . " GROUP by YEAR(date_debut) , nom_etablissement , nom_labo ORDER by YEAR(date_debut);";
        // dd($query);
        return DB::select($query);
    }
    public function searchDemande($etablissement, $entite, $annee)
    {


        $query = "SELECT  sum(case when " . $this->demandes . ".etat ='" . DemandeStatus::ACCEPTEE . "'" . " then 1 else 0 end) AS numdemandesAccp,
        sum(case when " . $this->demandes . ".etat ='" . DemandeStatus::REFUSEE . "'" . "then 1 else 0 end) AS numdemandesRefus" . ",sum(case when " . $this->demandes . ".etat ='" . DemandeStatus::COURANTE . "'" . " then 1 else 0 end) AS numdemandesCour" . ",date_debut,etablissement.nom  as nom_etablissement, laboratoire.nom as nom_labo FROM "
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
            . $this->manifestations . '.demande_id';

        if ($etablissement != "all" && $entite != "all" && $annee != "all") {

            $query = $query . " and  etab_id=" . $etablissement . " and id_labo=" . $entite . " and year(date_debut)=" . $annee;
        } else if ($entite != "all") {

            $query = $query . " and id_labo=" . $entite;
        } else if ($annee != "all") {
            $query = $query
                . " and year(date_debut)=" . $annee;
        } else if ($etablissement != "all") {
            $query = $query . " and etab_id=" . $etablissement;
        }
        $query = $query
            . " GROUP by YEAR(date_debut) , nom_etablissement , nom_labo ORDER by YEAR(date_debut);";
        $result = DB::select($query);
        return $result;
    }
    public function save($annee, $budget_fixe)
    {
        return  BudgetAnnuel::create(['annee' => $annee, 'budget_fixe' => $budget_fixe, 'budget_restant' => $budget_fixe]);
    }
    public function update($budget_fixe)
    {
        return  BudgetAnnuel::where('annee', Common::getAnneeActuelle())->update(['budget_fixe' => $budget_fixe, 'budget_restant' => $budget_fixe]);
    }
}
