<?php

namespace App\Models\Dto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $table ='departement';
    protected $connection = 'mysql2';
    protected $primaryKey = 'dep_id';

    public $fillable = [
        'dep_id',
        'nom',
        'etab_id',
        'resp_id',
        'structure_type',
        'created_at'
    ];

    public function responsable()
    {
        return $this->belongsTo(Chercheur::class, 'resp_id');
    }

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etab_id');
    }
}
