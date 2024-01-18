<?php

namespace App\Http\Controllers;

use App\Models\Calendari;
use App\Models\Menu;
use App\Models\plats;
use App\Models\Poble;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('restaurants')->with([
            'restaurants'=>Restaurant::all(),
            'pobles'=>Poble::all(),
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
        $data=$request->validate([
            'nom'=>'required',
            'poble'=>'required',
            'descripcio'=>'required',
            'direccio'=>'required',
            'foto'=>'required',
            'dilluns'=>'required',
            'dimarts'=>'required',
            'dimecres'=>'required',
            'dijous'=>'required',
            'divendres'=>'required',
            'dissabte'=>'required',
            'diumenge'=>'required',
        ]);

        $imatge=$request->file('foto');
        $nameImage = Str::uuid() . "." . $imatge->extension();
        $imatgeServer = Image::make($imatge);
        $imagePath = public_path('uploads') . '/' . $nameImage;
        $imatgeServer->fit(800,800);
        $imatgeServer->save($imagePath);

        $restaurant = Restaurant::create([
            'nom'=>$request->get('nom'),
            'poble'=>$request->get('poble'),
            'descripcio'=>$request->get('descripcio'),
            'direccio'=>$request->get('direccio'),
            'foto'=>$imagePath,
        ]);

        Calendari::create([
            'restaurant_id' => $restaurant->id,
            'dilluns' => $request->get('dilluns'),
            'dimarts' => $request->get('dimarts'),
            'dimecres' => $request->get('dimecres'),
            'dijous' => $request->get('dijous'),
            'divendres' => $request->get('divendres'),
            'dissabte' => $request->get('dissabte'),
            'diumenge' => $request->get('diumenge'),
        ]);

        return redirect()->route('restaurants');

    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $poble = Poble::find($restaurant->poble);
        return view('one-restaurant')->with([
            'restaurant'=>$restaurant,
            'poble'=>$poble,
        ]);
    }

    public function showMenus($restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);
        $menus = Menu::where('restaurant_id',$restaurant_id)->get();

        $menusArray=[];

        foreach ($menus as $menu){
            $primers_plats = plats::where('menu_id',$menu->id)->where('tipu_plat',1)->get();
            $segons_plats = plats::where('menu_id',$menu->id)->where('tipu_plat',2)->get();
            $postres = plats::where('menu_id',$menu->id)->where('tipu_plat',3)->get();
            $menusArray[]=[
                'id'=>$menu->id,
                'preu'=>$menu->preu,
                'title'=>$menu->title,
                'primers_plats'=>$primers_plats,
                'segons_plats'=>$segons_plats,
                'postres'=>$postres,
            ];
        }

        return view('llista-menus-restaurant')->with([
            'menus'=>$menusArray,
            'restaurant'=>$restaurant,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
    public function getByPoble(Request $request){

        $request->validate([
            'select_poble'=>'required',
        ]);

        $restaurants = Restaurant::where('poble',$request->get('select_poble'))->get();
        return view('restaurant-poble')->with([
            'restaurants'=>$restaurants,
            'poble'=>Poble::find($request->get('select_poble')),
        ]);
    }
}
