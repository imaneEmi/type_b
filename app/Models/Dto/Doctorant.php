<?php

namespace App\Models\Dto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctorant extends Model
{
    use HasFactory;
    protected $table ='doctorant';
    protected $connection = 'mysql2';
    protected $primaryKey = 'id_doct';

    public $fillable = [
        'id_doct',
        'nom',
        'prenom',
        'cne',
        'tel',
        'email',
        'cher_id',
    ];

   
    public function chercheur()
    {
        return $this->belongsTo(Chercheur::class, 'cher_id');
    }
 
}
