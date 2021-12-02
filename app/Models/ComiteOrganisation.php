<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComiteOrganisation extends Model
{
    use HasFactory;

    public $fillable = [
        'nom',
        'prenom',
        'email',
        'tel',
        'etablissement_id',
    ];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id');
    }
}
