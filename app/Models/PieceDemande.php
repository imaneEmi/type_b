<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceDemande extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'libelle',
        'description',
        'nbr_copie',
    ];
}
