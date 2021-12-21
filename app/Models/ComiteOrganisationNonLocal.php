<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComiteOrganisationNonLocal extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $fillable = [
        'nom',
        'prenom',
        'email',
        'tel',
        'universite',
        'etablissement',
        'ville',
        'manifestation_id'
    ];


}
