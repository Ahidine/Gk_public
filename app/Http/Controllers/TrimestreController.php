<?php

namespace App\Http\Controllers;

use App\Trimestre;
use App\Etude;
use Illuminate\Http\Request;
use App\Groupe;

class TrimestreController extends Controller
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
        $trimestre= new Trimestre;
        $trimestre->date_debut=$request->date_debut;
        $trimestre->date_fin=$request->date_fin;
        $trimestre->nom=$request->nom;
        $trimestre->save();
        return $trimestre;
    }
    public function getAllTrimestre()
    {
        return Trimestre::all();
    }
    public function getTrimestreById($id)
    {
        return Trimestre::find($id);
    }
    public function getTrimestreOfGroupe($id)
    {
    return $trimestre =  Groupe::find($id)->trimestre()->get();
    // Trimestre::with('groupe')->where('groupe_id',$id)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trimestre  $trimestre
     * @return \Illuminate\Http\Response
     */
    public function show(Trimestre $trimestre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trimestre  $trimestre
     * @return \Illuminate\Http\Response
     */
    public function edit(Trimestre $trimestre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trimestre  $trimestre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trimestre $trimestre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trimestre  $trimestre
     * @return \Illuminate\Http\Response
     */
    public function destroy( $trimestre)
    {
        //
        Trimestre::find($trimestre)->delete();
        return 1;
    }
}
