<?php

namespace App\Services;

use App\Models\BudgetAnnuel;

interface BudgetAnnuelService
{

    public function save($annee, $budget_fixe);
    public function findAll();
    public   function findAllOrderByAnneeDesc();
    public function findAllWithLimit($limit);
    public function updateBudgetActuel($budget_fixe);

    public function findById($id);
    public function update(BudgetAnnuel $budget);

    public function findBudgetParAnneeAndType($annee, $type);
    public function findBudgetParAnnee($annee);
    public function findAllAnnee();
    public function searchDemande($etablissement, $entite, $annee);
    public function searchBudget($etablissement, $entite, $annee);
}
