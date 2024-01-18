<?php

namespace App\Http\Controllers;

use App\Models\plats;
use App\Models\Poble;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome')->with([
            'pobles'=>Poble::all(),
        ]);
    }
    public function quiSom()
    {
        return view('qui-som');
    }
    public function onRepartim()
    {
        return view('on-repartim');
    }
}
