<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComiteScientifiqueNonLocal extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $fillable = [
        'nom',
        'prenom',
        'email',
        'tel',
        'type_entite',
        'nom_entite',
        'pays'
    ];

  
}
