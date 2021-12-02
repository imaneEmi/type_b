<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestationContributeur extends Model
{
    use HasFactory;

    public $fillable = [
        'contributeur_id',
        'manifestation_id',
    ];

    public function contributeur()
    {
        return $this->belongsTo(Contributeur::class, 'contributeur_id');
    }
}
