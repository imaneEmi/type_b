<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoutienSollicite extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $with=['fraisCouvert'];
    public $fillable = [
        'nbr',
        'montant',
        'remarques',
        'frais_couvert_id',
        'manifestation_id',
    ];

    public function fraisCouvert(){
        return $this->belongsTo(FraisCouvert::class,'frais_couvert_id');
    }
}
