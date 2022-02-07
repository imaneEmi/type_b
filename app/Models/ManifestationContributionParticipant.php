<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestationContributionParticipant extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $with = ['contributionParticipant'];
    public $fillable = [
        'cont_par_id',
        'manifestation_id',
    ];

    public function  contributionParticipant()
    {
        return $this->belongsTo(ContributionParticipant::class, 'cont_par_id');
    }
    public function  natureContribution()
    {
        return $this->belongsTo(ContributionParticipant::class, 'cont_par_id');
    }
}
