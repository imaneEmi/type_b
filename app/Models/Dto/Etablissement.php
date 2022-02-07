<?php

namespace App\Models\Dto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;
    protected $table ='etablissement';
    protected $connection = 'mysql2';

    public $fillable = [
        'id',
        'nom',
        'ville',
        'created_at',
    ];

    public function laboratoires()
    {
        return $this->hasMany(Laboratoire::class,'etab_id');
    }
}
