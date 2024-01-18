<?php

namespace App\Http\Controllers;

use App\Models\plats;
use App\Models\PlatSol;
use App\Models\Restaurant;
use App\Models\TipusPlat;
use App\Models\ToGoodToGoRestaurant;
use Illuminate\Http\Request;

class ToGoodToGoRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);
        $configuracions = ToGoodToGoRestaurant::where('restaurant_id',$restaurant_id)->get();
        $tipus_plats = TipusPlat::all();
        return view('configurar-togoodtogo')->with([
            'restaurant'=>$restaurant,
            'configuracions'=>$configuracions,
            'tipus_plats'=>$tipus_plats,
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

    }

    public function store_description(Request $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);
        $restaurant->desc_mistery_box=$request->desc_mistery_box;
        $restaurant->preu_mistery_box=$request->preu_mistery_box;
        $restaurant->save();

        return redirect()->route('togood-configure',['restaurant_id'=>$request->restaurant_id]);
    }

    public function store_configuration(Request $req)
    {
        $data=$req->validate([
            'restaurant_id'=>'required',
            'tipus_plat_id'=>'required',
            'quantitat'=>'required',
        ]);

        ToGoodToGoRestaurant::create([
            'restaurant_id'=>$req->restaurant_id,
            'tipus_plat_id'=>$req->tipus_plat_id,
            'quantitat'=>$req->quantitat,
        ]);
        return redirect()->route('togood-configure',['restaurant_id'=>$req->restaurant_id]);
    }

    public function generate_mistery_box($restaurant_id)
    {
        $resultats_mistery_box = array();
        $configuracions = ToGoodToGoRestaurant::where('restaurant_id',$restaurant_id)->get();
        foreach ($configuracions as $conf){
            for ($i = 0; $i < $conf->quantitat; $i++) {
                $plats = PlatSol::where('restaurant_id',$restaurant_id)->where('tipus_plat',$conf->tipus_plat_id)->get();
                $plat_definitiu = $this->obtenir_valor_aleatori($plats);
                $resultats_mistery_box[]=$plat_definitiu;
            }
        }
        return $resultats_mistery_box;
    }

    public function obtenir_valor_aleatori($array){
        $claveAleatoria= rand(0,sizeof($array)-1);
        return $array[$claveAleatoria];
    }

    /**
     * Display the specified resource.
     */
    public function show(ToGoodToGoRestaurant $toGoodToGoRestaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToGoodToGoRestaurant $toGoodToGoRestaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToGoodToGoRestaurant $toGoodToGoRestaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,$restaurant_id)
    {
        ToGoodToGoRestaurant::destroy($id);
        return redirect()->route('togood-configure',['restaurant_id'=>$restaurant_id]);
    }
}
