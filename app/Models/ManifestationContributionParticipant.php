<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestationContributionParticipant extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $fillable = [
        'contribution_participant_id',
        'manifestation_id',
    ];

  
}
