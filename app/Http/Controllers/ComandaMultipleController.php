<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\ComandaMultiple;
use App\Models\LiniaComanda;
use App\Models\LiniaComandaMultiple;
use App\Models\PlatSol;
use App\Models\Restaurant;
use App\Models\ToGoodToGo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComandaMultipleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        //Agafo totes les comandes de l'usuari
        $comandes_multiples = ComandaMultiple::where('user_id',$user_id)->get();

        $data = [];

        foreach ($comandes_multiples as $key=>$cm) {
            $linies = LiniaComandaMultiple::where('comanda_multpile_id',$cm->id)->get();
            $comanda = [
                'id' => $cm->id,
                'data' => $cm->updated_at,
                'user_id' => $cm->user_id,
                'preu' => $cm->preu,
            ];
            foreach ($linies as $l){
                $nom='';
                if ($l->plat_sol_id){
                    $producte = PlatSol::find($l->plat_sol_id);
                    $nom=$producte->nom_plat;
                }
                if ($l->togoodtogo_id) {
                    $producte = ToGoodToGo::find($l->togoodtogo_id);
                    $nom=$producte->nom;
                }
                $comanda['linies'][]=[
                    'id'=>$l->id,
                    'nom'=>$nom,
                    'comanda_multiple_id'=>$l->comanda_multpile_id,
                    'plat_sol_id'=>$l->plat_sol_id,
                    'togoodtogo_id'=>$l->togoodtogo_id,
                    'quantitat'=>$l->quantitat,
                ];
            }
            $data[]=$comanda;
        }

        return view('comandes-multiples-usuari')->with([
            'data'=>$data,
        ]);

//        dd($comandes_multiples);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cm = ComandaMultiple::create([
            'user_id'=>Auth::user()->id,
            'preu' => 0,
        ]);
        $preu = 0;
        foreach ($request->data as $l){
            LiniaComandaMultiple::create([
                'comanda_multpile_id'=>$cm->id,
                'togoodtogo_id'=>$l['producte_id'],
                'quantitat'=>$l['quantitat'],
            ]);
            $preu = $preu + $l['preu'] * $l['quantitat'];
        }

        $cm->preu=$preu;

        $cm->save();

        return response()->json(['redirect_url'=>route('home')]);

    }

    public function store_mistery_box(Request $req){

        $rest = Restaurant::find($req->restaurant_id);

        $cm = ComandaMultiple::create([
           'user_id'=>Auth::user()->id,
           'preu'=>$rest->preu_mistery_box,
        ]);

        foreach ($req->data as $l){
            LiniaComandaMultiple::create([
                'comanda_multpile_id'=>$cm->id,
                'plat_sol_id'=>$l['id'],
                'quantitat'=>1,
            ]);
        }

        return response()->json(['redirect_url'=>route('home')]);

    }

    /**
     * Display the specified resource.
     */
    public function show(ComandaMultiple $comandaMultiple)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComandaMultiple $comandaMultiple)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComandaMultiple $comandaMultiple)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComandaMultiple $comandaMultiple)
    {
        //
    }
}
