<?php

namespace App\Http\Controllers;

use App\Pays;
use App\Ville;
use Illuminate\Http\Request;

class PaysController extends Controller
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
            'ville'=>[ 'required', 'min:3','alpha'],
            'pays'=>[ 'required', 'min:3','alpha'],
        
        ]
        );
        $pays=new Pays;
        $pays->nom=$request->pays;
        $pays->save();
        $ville= new Ville;
        $ville->nom=$request->ville;
        $ville->pays_id=$pays->id;
        $ville->save();
        return $pays;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pays  $pays
     * @return \Illuminate\Http\Response
     */
    public function show(Pays $pays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pays  $pays
     * @return \Illuminate\Http\Response
     */
    public function edit(Pays $pays)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pays  $pays
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pays $pays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pays  $pays
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pays $pays)
    {
        //
    }
}
