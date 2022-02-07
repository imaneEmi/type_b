<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $with = ['manifestation'];
    protected $dates = ['date_envoie'];

    public $fillable = [
        'code',
        'date_envoie',
        'etat',
        'editable',
        'remarques',
        'coordonnateur_id',

    ];

    public function manifestation(){
        return $this->hasOne(Manifestation::class);
    }
}
