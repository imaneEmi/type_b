<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComiteOrganisationLocal extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $fillable = [
           'id_cher',
           'manifestation_id'
    ];


}
