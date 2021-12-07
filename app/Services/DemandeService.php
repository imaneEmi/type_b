<?php

namespace App\Services;

use App\Services\config\Config;

interface DemandeService
{
    public function findAll();
    public function getAll();
    public function findById($id);
    public function save($demande);
    public function update($demande);
    public function changeEtat($id, $etat);
    public function delete($id);
    public function findByEtat($etat);
    public function getNbrDemandesParEtatAnneeCour($etat);
    public function getNbrDemandesAnneeCour();
    public  function nbrDemandeParEtablissAnneeCour();
}
