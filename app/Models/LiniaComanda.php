<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiniaComanda extends Model
{
    use HasFactory;

    public $fillable = [
        'comanda_id',
        'primer_plat',
        'segon_plat',
        'postres',
        'preu',
    ];

}
