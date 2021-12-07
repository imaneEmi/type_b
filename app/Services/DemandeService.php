<?php

namespace App\Services;

interface DemandeService
{
    public function findAll();
    public function getAll();
    public function findById($id);
    public function save($demande);
    public function update($demande);
    public function changeEtat($id,$etat);
    public function delete($id);
    public function findByEtat($etat);
    public function getNbrDemandesRefusees();
    public function getNbrDemandesAcceptees();
    public function getNbrDemandes();
}
