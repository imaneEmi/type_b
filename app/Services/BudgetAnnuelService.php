<?php

namespace App\Services;

use App\Models\BudgetAnnuel;

interface BudgetAnnuelService
{
 
    public function save($annee,$budget_fixe);
    public function findAll();
    public function findAllWithLimit($limit);

    public function findBudgetParAnneeAndType($annee, $type);
    public function findBudgetParAnnee($annee);
    public function findAllAnnee();
    public function findBudgetConsommeeParEtab($idEtablissement);
    public function findBudgetConsommee();
    public function findBudgetConsommeeParEtabParEntiteParAnnee($idEtablissement, $idEntite, $annee);
    public function findBudgetConsommeeParEntiteParAnnee($idEntite, $annee);
    public function findBudgetConsommeeParEtabParAnnee($idEtablissement, $annee);
    public function findBudgetConsommeeParAnnee($annee);
    public function findBudgetConsommeeParEtabParEntite($idEtablissement, $idEntite);
 }
