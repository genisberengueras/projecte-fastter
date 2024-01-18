<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatSol extends Model
{
    use HasFactory;

    public $fillable = [
        'restaurant_id',
        'nom_plat',
        'preu',
        'tipus_plat',
    ];
}
