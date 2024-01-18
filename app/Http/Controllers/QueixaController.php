<?php

namespace App\Http\Controllers;

use App\Models\Queixa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueixaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('queixes')->with([
           'queixes'=>Queixa::all(),
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
            'descripcio'=>'required',
        ]);
        Queixa::create([
            'descripcio'=>$request->descripcio,
            'user_id'=>Auth::user()->id,
            'desc_extensa'=>$request->desc_extensa,
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Queixa $queixa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Queixa $queixa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Queixa $queixa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Queixa $queixa)
    {
        //
    }
}
