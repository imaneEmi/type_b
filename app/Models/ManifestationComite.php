<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestationComite extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $fillable = [
        'comite_organisation_id',
        'manifestation_id',
    ];

    public function comiteOrganisation()
    {
        return $this->belongsTo(ComiteOrganisation::class, 'comite_organisation_id');
    }
  
}
