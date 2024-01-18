<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendari extends Model
{
    use HasFactory;

    public $fillable = [
        'restaurant_id',
        'dilluns',
        'dimarts',
        'dimecres',
        'dijous',
        'divendres',
        'dissabte',
        'diumenge'
    ];
}
