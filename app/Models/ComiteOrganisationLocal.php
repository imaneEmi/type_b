<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComiteOrganisationLocal extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $with=['etablissement'];
    public $fillable = [
           'id_cher'
    ];

 
}
