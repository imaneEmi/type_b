<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributeur extends Model
{
    use HasFactory;

    public $fillable = [
        'type_contributeur_id',
        'nom',
        'montant',
        'nature_contribution_id',
    ];

    public function typeContributeur()
    {
        return $this->belongsTo(TypeContributeur::class, 'type_contributeur_id');
    }
    public function natureContribution()
    {
        return $this->belongsTo(NatureContribution::class, 'nature_contribution_id');
    }


    
    
}
