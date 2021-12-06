<?php

namespace App\Services;

interface DemandeService
{
    public function findAll();
    public function findById($id);
    public function save($demande);
    public function update($demande);
    public function changeEtat($id,$etat);
    public function delete($id);
    public function findByEtat($etat,$manifestationService);
    public function getNbrDemandesRefusees();
    public function getNbrDemandesAcceptees();
    public function getNbrDemandes();
}
