<?php

namespace App\Services;

use App\Services\config\Config;

interface DemandeService
{
    public function findAll();
    public function findById($id);
    public function save($demande);
    public function update($demande);
    public function delete($id);
    public function findByEtat($etat, $manifestationService);
    public function getNbrDemandesParEtatAnneeCour($etat);
    public function getNbrDemandesAnneeCour();
    public  function nbrDemandeParEtablissAnneeCour();
}
