<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'preu_total',
        'comanda',
        'direccio',
    ];
}
