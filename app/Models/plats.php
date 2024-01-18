<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plats extends Model
{
    use HasFactory;

    public $fillable = [
        'tipu_plat',
        'plat',
        'menu_id',
    ];

}
