<?php

namespace App\Services\ServicesImpl;

use App\Models\BudgetAnnuel;
use App\Models\Dto\Laboratoire;
use App\Services\BudgetAnnuelService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BudgetAnnuelServiceImpl implements BudgetAnnuelService
{

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

    public function findBudgetConsommee()
    {
        $manifestations = env('DB_DATABASE') . ".manifestations";
        $soutien_accordes = env('DB_DATABASE') . ".soutien_accordes";
        return Laboratoire::select('montant', 'date_debut', 'etablissement.nom as nom_etablissement', 'laboratoire.nom as nom_labo')->join('etablissement', 'etab_id', '=', 'etablissement.id')->join($manifestations, 'laboratoire.id_labo', '=', 'manifestations.entite_organisatrice_id')
            ->join($soutien_accordes, 'manifestation_id', '=', 'manifestations.id')->orderBy('date_debut')->get();
    }
    public function findBudgetConsommeeParEtab($idEtablissement)
    {
        $manifestations = env('DB_DATABASE') . ".manifestations";
        $soutien_accordes = env('DB_DATABASE') . ".soutien_accordes";
        return Laboratoire::select('montant', 'date_debut', 'etablissement.nom as nom_etablissement', 'laboratoire.nom as nom_labo')->join('etablissement', 'etab_id', '=', 'etablissement.id')->join($manifestations, 'laboratoire.id_labo', '=', 'manifestations.entite_organisatrice_id')
            ->join($soutien_accordes, 'manifestation_id', '=', 'manifestations.id')->where('etab_id', '=', $idEtablissement)->orderBy('date_debut')->get();
    }
    public function findBudgetConsommeeParEtabParEntite($idEtablissement, $idEntite)
    {
        $manifestations = env('DB_DATABASE') . ".manifestations";
        $soutien_accordes = env('DB_DATABASE') . ".soutien_accordes";
        return  Laboratoire::select('montant', 'date_debut', 'etablissement.nom as nom_etablissement', 'laboratoire.nom as nom_labo')->join('etablissement', 'etab_id', '=', 'etablissement.id')->join($manifestations, 'laboratoire.id_labo', '=', 'manifestations.entite_organisatrice_id')
            ->join($soutien_accordes, 'manifestation_id', '=', 'manifestations.id')->where('etab_id', '=', $idEtablissement)->where('entite_organisatrice_id', '=', $idEntite)->orderBy('date_debut')->get();
    }
    public function findBudgetConsommeeParEtabParEntiteParAnnee($idEtablissement, $idEntite, $annee)
    {
        $manifestations = env('DB_DATABASE') . ".manifestations";
        $soutien_accordes = env('DB_DATABASE') . ".soutien_accordes";
        return  Laboratoire::select('montant', 'date_debut', 'etablissement.nom as nom_etablissement', 'laboratoire.nom as nom_labo')->join('etablissement', 'etab_id', '=', 'etablissement.id')->join($manifestations, 'laboratoire.id_labo', '=', 'manifestations.entite_organisatrice_id')
            ->join($soutien_accordes, 'manifestation_id', '=', 'manifestations.id')->where('etab_id', '=', $idEtablissement)->where('entite_organisatrice_id', '=', $idEntite)->whereYear('date_debut', '=', $annee)->get();
    }
    public function findBudgetConsommeeParEntiteParAnnee($idEntite, $annee)
    {
        $manifestations = env('DB_DATABASE') . ".manifestations";
        $soutien_accordes = env('DB_DATABASE') . ".soutien_accordes";
        return  Laboratoire::select('montant', 'date_debut', 'etablissement.nom as nom_etablissement', 'laboratoire.nom as nom_labo')->join('etablissement', 'etab_id', '=', 'etablissement.id')->join($manifestations, 'laboratoire.id_labo', '=', 'manifestations.entite_organisatrice_id')
            ->join($soutien_accordes, 'manifestation_id', '=', 'manifestations.id')->where('entite_organisatrice_id', '=', $idEntite)->whereYear('date_debut', '=', $annee)->get();
    }
    public function findBudgetConsommeeParEtabParAnnee($idEtablissement, $annee)
    {
        $manifestations = env('DB_DATABASE') . ".manifestations";
        $soutien_accordes = env('DB_DATABASE') . ".soutien_accordes";
        return  Laboratoire::select('montant', 'date_debut', 'etablissement.nom as nom_etablissement', 'laboratoire.nom as nom_labo')->join('etablissement', 'etab_id', '=', 'etablissement.id')->join($manifestations, 'laboratoire.id_labo', '=', 'manifestations.entite_organisatrice_id')
            ->join($soutien_accordes, 'manifestation_id', '=', 'manifestations.id')->where('etab_id', '=', $idEtablissement)->whereYear('date_debut', '=', $annee)->get();
    }
    public function findBudgetConsommeeParAnnee($annee)
    {
        $manifestations = env('DB_DATABASE') . ".manifestations";
        $soutien_accordes = env('DB_DATABASE') . ".soutien_accordes";
        return  Laboratoire::select('montant', 'date_debut', 'etablissement.nom as nom_etablissement', 'laboratoire.nom as nom_labo')->join('etablissement', 'etab_id', '=', 'etablissement.id')->join($manifestations, 'laboratoire.id_labo', '=', 'manifestations.entite_organisatrice_id')
            ->join($soutien_accordes, 'manifestation_id', '=', 'manifestations.id')->whereYear('date_debut', '=', $annee)->get();
    }
    public function save($annee, $budget_fixe)
    {
        return  BudgetAnnuel::create(['annee' => $annee, 'budget_fixe' => $budget_fixe, 'budget_restant' => $budget_fixe]);
    }
    public  function findById($id)
    {
        return BudgetAnnuel::find($id);
    }
    public function update(BudgetAnnuel $budget)
    {
        if ($this->findById($budget->id) != null) {
            return $budget->save();
        }
    }
}
