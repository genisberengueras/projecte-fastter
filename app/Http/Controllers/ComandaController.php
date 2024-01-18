<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\LiniaComanda;
use App\Models\Menu;
use App\Models\plats;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($menu_id)
    {

        $menu = Menu::find($menu_id);

        $primers_plats=plats::where('menu_id',$menu_id)->where('tipu_plat',1)->get();

        $segons_plats=plats::where('menu_id',$menu_id)->where('tipu_plat',2)->get();

        $postres=plats::where('menu_id',$menu_id)->where('tipu_plat',3)->get();

        $menu_completo=array(
            'id'=>$menu->id,
            'nom_menu'=>$menu->title,
            'primers_plats'=>$primers_plats,
            'segons_plats'=>$segons_plats,
            'postres'=>$postres,
            'preu'=>$menu->preu,
        );


        return view('comanda-menu')->with([
            'menu'=>$menu_completo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'primer_plat'=>'required',
            'segon_plat'=>'required',
            'postres'=>'required',
        ]);

        $menu = Menu::find($request->menu_id);

        $comanda = Comanda::create([
            'user_id'=>Auth::user()->id,
            'preu_total'=>$menu->preu,
            'data'=>new \DateTime(),
            'direccio'=>$request->direccio,
        ]);

        $primer_plat = plats::find($request->primer_plat);
        $segon_plat = plats::find($request->segon_plat);
        $postres = plats::find($request->postres);

        LiniaComanda::create([
            'comanda_id'=>$comanda->id,
            'primer_plat'=>$primer_plat->plat,
            'segon_plat'=>$segon_plat->plat,
            'postres'=>$postres->plat,
            'preu'=>$menu->preu,
        ]);

        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     */
    public function show(Comanda $comanda)
    {
        //
    }

    public function getComandesUsuari($user_id){
        $user = User::find($user_id);
        $comandes = Comanda::where('user_id',$user_id)->get();

        $comandesAux = [];

        foreach ($comandes as $c) {
            $linies = LiniaComanda::where('comanda_id',$c->id)->get();
            $comandesAux[]=[
                'comanda'=>$c,
                'linies'=>$linies,
            ];
        }

        return view('comandes-usuari')->with([
            'user'=>$user,
            'comandes'=>$comandesAux,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comanda $comanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comanda $comanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comanda $comanda)
    {
        //
    }
}
