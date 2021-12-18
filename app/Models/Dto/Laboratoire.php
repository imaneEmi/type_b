<?php

namespace App\Models\Dto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratoire extends Model
{
    use HasFactory;
    protected $table ='laboratoire';
    protected $connection = 'mysql2';
    protected $primaryKey = 'id_labo';

    public $fillable = [
        'id_labo',
        'nom',
        'etab_id',
    ];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etab_id');
    }
}
