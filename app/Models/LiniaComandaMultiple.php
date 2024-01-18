<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiniaComandaMultiple extends Model
{
    use HasFactory;

    public $fillable = [
        'comanda_multpile_id',
        'plat_sol_id',
        'togoodtogo_id',
        'quantitat',
    ];
}
