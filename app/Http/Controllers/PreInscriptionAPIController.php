<?php

namespace App\Http\Controllers;

use App\Eleve;
use App\Centre;
use Illuminate\Http\Request;

use App\Http\Requests\ElevePostRequest;
use App\Http\Resources\PreInscriptionsResource;

class PreInscriptionAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eleve=Eleve::all();
        return PreInscriptionsResource::collection($eleve);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ElevePostRequest $request)
    {

        $centre = Centre::where('nom','=',$request->centre_name)->first();
      
        $eleve= new Eleve();
        $eleve->nom=$request->nom;
        $eleve->prenom=$request->prenom;
        $eleve->age=$request->age;
        $eleve->numero=$request->numero;
        $eleve->comment=$request->comment;
        $eleve->centre_id=$centre->id;
        $eleve->path_photo='null';
        $eleve->lieu_naissance='null';
        $eleve->nationalite='null';
        $eleve->adresse='null';
        $eleve->Est_Inscrit=0;
        if ($eleve->save()) {
              return  new PreInscriptionsResource($eleve);

    }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $eleve=Eleve::findOrFail($id);
        return new PreInscriptionsResource($eleve);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id) 
    {
        //
        $eleve= Eleve::findOrFail($id);;
        $eleve->nom=$request->nom;
        $eleve->prenom=$request->prenom;
        $eleve->date_naissance=$request->date_naissance;
        $eleve->numero=$request->numero;
        $eleve->comment=$request->comment;
        $eleve->centre_id=$centre->id;
        $eleve->path_photo='null';
        $eleve->lieu_naissance='null';
        $eleve->sex='null';
        $eleve->nationalite='null';
        $eleve->adresse='null';
        $eleve->Est_Inscrit=0;
        $eleve->update();

        return  new PreInscriptionsResource($eleve);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $eleve = Eleve::findOrFail($id);
        if ($eleve->delete()) {
           return new PreInscriptionsResource($eleve);
        }
    }
}
