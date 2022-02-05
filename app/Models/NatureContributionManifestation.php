<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureContributionManifestation extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $with = ['natureContribution'];
    public $fillable = [
        'nature_con_id',
        'manifestation_id',
    ];

    public function  natureContribution()
    {
        return $this->belongsTo(NatureContribution::class, 'nature_con_id');
    }
}
