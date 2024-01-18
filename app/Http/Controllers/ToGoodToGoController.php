<?php

namespace App\Http\Controllers;

use App\Models\ToGoodToGo;
use Illuminate\Http\Request;

class ToGoodToGoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $togoodtogo = ToGoodToGo::all();

        return view('togoodtogo')->with([
            'togoodtogo'=>$togoodtogo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('togoodtogo-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'nom'=>'required',
           'preu'=>'required',
           'data'=>'required',
           'quantitat'=>'required',
        ]);

        ToGoodToGo::create([
            'nom'=>$request->nom,
            'preu'=>$request->preu,
            'data'=>$request->data,
            'quantitat'=>$request->quantitat
        ]);

        return redirect()->route('togoodtogo');
    }

    /**
     * Display the specified resource.
     */
    public function show(ToGoodToGo $toGoodToGo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToGoodToGo $toGoodToGo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToGoodToGo $toGoodToGo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ToGoodToGo $toGoodToGo)
    {
        //
    }
}
