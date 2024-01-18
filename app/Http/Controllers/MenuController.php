<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $restaurant=Restaurant::find($id);
        $menus=Menu::where('restaurant_id',$id)->get();
        return view('menus-restaurant')->with([
            'restaurant'=>$restaurant,
            'menus'=>$menus,
        ]);
//        dd($id);
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

        $validate=$request->validate([
            'title'=>'required',
            'preu'=>'required',
        ]);

        $menu=Menu::create([
            'title'=>$request->title,
            'preu'=>$request->preu,
            'restaurant_id'=>$request->get('restaurant_id'),
        ]);

        return redirect()->route('restaurants');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
