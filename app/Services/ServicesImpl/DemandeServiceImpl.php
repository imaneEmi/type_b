<?php

namespace App\Services\ServicesImpl;

use App\Models\Demande;
use App\Services\DemandeService;
use PhpParser\Node\Expr\Cast\Array_;

class DemandeServiceImpl implements DemandeService
{
    public function __construct()
    {

    }
    public function findAll(){
        return Demande::all();
    }
    public function findById($id){
        return Demande::findOrFail($id);
    }
    public function save($demande){
        return Demande::create($demande);
    }
    public function update($demande){
        return $demande->save();
    }
    public function changeEtat($id,$etat){
        $demande = $this->findById($id);
        $demande->etat = $etat;
        $demande->save();
        return 1;
    }
    public function delete($id){
        $demande = $this->findById($id);
        return $demande->delete();
    }

    public function findByEtat($etat,$manifestationService){
        $demandes = Demande::where('etat',$etat)->with('coordonnateur','manifestation')->get();
        return ['demandes'=>$demandes];
    }
    public function getNbrDemandes()
    {
        return $this->findAll()->count();
    }
    public function getNbrDemandesAcceptees()
    {
        return Demande::where('etat', 'Acceptée')->get()->count();
    }
    public function getNbrDemandesRefusees()
    {
        return Demande::where('etat', 'Refusée')->get()->count();
    }
}
