<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileManifestation extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $fillable = [
        'url',
        'manifestation_id',
    ];
}
