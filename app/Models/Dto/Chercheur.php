<?php

namespace App\Models\Dto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chercheur extends Model
{
    use HasFactory;
    protected $table ='chercheur';
    protected $connection = 'mysql2';
    protected $with = ['laboratoire'];
    protected $primaryKey = 'id_cher';
    public $fillable = [
        'id_cher',
        'nom',
        'prenom',
        'grade',
        'tel',
        'email',
        'lab_id',
        'specialite'
    ];

    public function laboratoire()
    {
        return $this->belongsTo(Laboratoire::class, 'lab_id');
    }
 
}
