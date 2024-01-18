<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToGoodToGoRestaurant extends Model
{
    use HasFactory;

    public $fillable = [
        'tipus_plat_id',
        'quantitat',
        'restaurant_id'
    ];

}
