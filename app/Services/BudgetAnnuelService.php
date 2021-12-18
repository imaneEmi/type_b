<?php

namespace App\Services;

interface BudgetAnnuelService
{
    public function findAll();
    public function findAllWithLimit($limit);

    public function findBudgetParAnneeAndType($annee, $type);
    public function findBudgetParAnnee($annee);
    public function findAllAnnee();
}
