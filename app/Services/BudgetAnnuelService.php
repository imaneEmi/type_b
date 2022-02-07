<?php

namespace App\Services;

use App\Models\BudgetAnnuel;

interface BudgetAnnuelService
{

    public function save($annee, $budget_fixe);
    public function findAll();
    public function findAllWithLimit($limit);
    public function update($budget_fixe);

    public function findBudgetParAnneeAndType($annee, $type);
    public function findBudgetParAnnee($annee);
    public function findAllAnnee();
    public function searchDemande($etablissement, $entite, $annee);
    public function searchBudget($etablissement, $entite, $annee);
}
