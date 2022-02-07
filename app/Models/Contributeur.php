<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributeur extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $with = ['natureContribution', 'typeContributeur'];

    public $fillable = [
        'nom',
        'montant',
        'nature_contribution_id',
        'type_contributeur_id'
    ];

    public function natureContribution()
    {
        return $this->belongsTo(NatureContribution::class, 'nature_contribution_id');
    }

    public function typeContributeur()
    {
        return $this->belongsTo(TypeContributeur::class, 'type_contributeur_id');
    }
}
