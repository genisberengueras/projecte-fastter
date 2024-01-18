<?php

namespace App\Http\Controllers;

use App\Models\plats;
use Illuminate\Http\Request;

class PlatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($menu_id)
    {
        return view('afegir-plats-menu')->with([
            'menu_id'=>$menu_id,
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
           'plat'=>'required',
           'tipu_plat'=>'required',
        ]);

        $plat=plats::create([
            'menu_id'=>$request->menu_id,
            'plat'=>$request->plat,
            'tipu_plat'=>$request->tipu_plat,
        ]);

        return redirect()->route('plats',['menu_id'=>$request->menu_id]);

    }

    /**
     * Display the specified resource.
     */
    public function show(plats $plats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(plats $plats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, plats $plats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(plats $plats)
    {
        //
    }
}
