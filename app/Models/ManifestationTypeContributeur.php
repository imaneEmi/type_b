<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestationTypeContributeur extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $with=['typeContributeur'];

    public $fillable = [
        'type_contributeur_id',
        'manifestation_id',
    ];

  public function typeContributeur()
    {
        return $this->belongsTo(TypeContributeur::class, 'type_contributeur_id');
    }
}
