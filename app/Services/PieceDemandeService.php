<?php

namespace App\Services;

interface PieceDemandeService
{
    public function findAll();
    public function findById($id);
    public function save($piece);
    public function update($piece);
    public function delete($id);
}
