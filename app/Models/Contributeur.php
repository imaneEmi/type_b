<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributeur extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $with=['natureContribution'];

    public $fillable = [
        'nom',
        'montant',
        'nature_contribution_id',
    ];

    public function natureContribution()
    {
        return $this->belongsTo(NatureContribution::class, 'nature_contribution_id');
    }




}
