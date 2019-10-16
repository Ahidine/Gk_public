<?php

namespace App\Http\Controllers;

use App\Ville;
use Illuminate\Http\Request;
use App\Pays;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'ville'=>['required','min:3'],
        ]
        );
        $pays_id=Pays::where('nom',$request->pays)->first()->id;
        $ville=new Ville;
        $ville->nom=$request->ville;
        $ville->pays_id=$pays_id;
        $ville->save();
        return $ville;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function show(Ville $ville)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function edit(Ville $ville)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ville $ville)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ville $ville)
    {
        //
    }
    public function getBelgiqueVille()
    {
         $pays=Pays::where('nom','Belgique')->first()->id;
        return Ville::where('pays_id',$pays)->get();
    }
}
