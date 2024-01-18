<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queixa extends Model
{
    use HasFactory;

    public $fillable = [
        'descripcio',
        'user_id',
        'desc_extensa'
    ];
}
