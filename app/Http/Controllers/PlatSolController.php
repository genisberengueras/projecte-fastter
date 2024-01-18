<?php

namespace App\Http\Controllers;

use App\Models\PlatSol;
use App\Models\Restaurant;
use App\Models\TipusPlat;
use Illuminate\Http\Request;

class PlatSolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);

        $tipus = TipusPlat::all();

        $plats = PlatSol::where('restaurant_id',$restaurant_id)->get();

        return view('plats-sols')->with([
            'restaurant' => $restaurant,
            'tipus' => $tipus,
            'plats' => $plats,
        ]);
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
        $data = $request->validate([
            'nom_plat'=>'required',
            'preu'=>'required',
            'tipus_plat'=>'required',
        ]);

        PlatSol::create([
           'restaurant_id'=>$request->restaurant_id,
           'nom_plat'=>$request->nom_plat,
           'preu'=>$request->preu,
           'tipus_plat'=>$request->tipus_plat,
        ]);

        return redirect()->route('plats-sols',['restaurant_id'=>$request->restaurant_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlatSol $platSol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlatSol $platSol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlatSol $platSol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlatSol $platSol)
    {
        //
    }
}
