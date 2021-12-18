<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestationContributionParticipant extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $fillable = [
        'cont_par_id',
        'manifestation_id',
    ];

  
}
