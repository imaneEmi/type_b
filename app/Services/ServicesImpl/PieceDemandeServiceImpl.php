<?php

namespace App\Services\ServicesImpl;

use App\Models\PieceDemande;
use App\Services\PieceDemandeService;

class DemandeServiceImpl implements PieceDemandeService
{
    public function __construct()
    {

    }
    public function findAll(){
        return PieceDemande::all();
    }
    public function findById($id){
        return PieceDemande::findOrFail($id);
    }
    public function save($piece){
        return PieceDemande::create($piece);
    }
    public function update($piece){
        return $piece->save();
    }
    public function delete($id){
        $piece = $this->findById($id);
        return $piece->delete();
    }
}
