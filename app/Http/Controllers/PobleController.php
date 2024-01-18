<?php

namespace App\Http\Controllers;

use App\Models\Poble;
use Illuminate\Http\Request;

class PobleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('addpoble');
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
            'nom'=>'required',
        ]);

        Poble::create([
            'nom'=>$request->nom,
        ]);

        return redirect()->route('pobles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poble $poble)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poble $poble)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poble $poble)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poble $poble)
    {
        //
    }
}
