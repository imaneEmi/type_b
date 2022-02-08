<?php

namespace App\Services;

use App\Services\config\Config;

interface DemandeService
{
    public function findAll();
    public function getAll($chercheurService);
    public function findById($id);
    public function save($demande);
    public function update($demande);
    public function changeEtat($id, $etat);
    public function delete($id);
    public function countCoordonnateurDemandeByCurrentYear($chercheur);
    public function findByEtat($etat, $chercheurService);
    public function getNbrDemandesParEtatAnneeCour($etat);
    public function getNbrDemandesAnneeCour();
    public function nbrDemandeParEtablissAnneeCour();
    public function isAllRapportLaboratoireExists($chercheur);
    public function  findByCoordonnateurId($id);
    public function findAllByCoordonnateurIdAndCurrentYear($id);
    public function findAllByChercheur($chercheur);
}
