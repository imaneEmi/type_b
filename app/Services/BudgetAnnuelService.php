<?php

namespace App\Services;

interface BudgetAnnuelService
{
    public function findAll();
    public function findBudgetParAnneeAndType($annee, $type);
    public function findBudgetParAnnee($annee);
}
