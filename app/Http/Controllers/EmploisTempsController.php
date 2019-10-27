<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emplois_temps;
use App\Groupe;
use App\Jours; 
use App\Professeur;
use App\Salle;
use App\Trimestre;
class EmploisTempsController extends Controller
{
    //
  public function getEmploisTempsByGroupe($id)
  {
    $trimestre=Emplois_temps::with('trimestre')->where('groupe_id',$id)->distinct()->get('trimestre_id');
    $jours=Jours::all();
    if (sizeof($trimestre) > 0) {
      
    $emplois =Emplois_temps::with(['prof'=> function($q)
    {
      $q->with('employe');
    }])->with('groupe','salle','jour','module')
    ->where('groupe_id',$id)
    ->where('trimestre_id',$trimestre[0]->trimestre_id)
    ->orderBy('jour_id')
    ->get();
   }
    else
    $emplois = '';


    return compact('jours','emplois','trimestre');
  }
  public function getEmploisByProf($id)
  {
    $trimestre=Emplois_temps::with('trimestre')->where('prof_id',$id)->distinct()->get('trimestre_id');
    if( sizeof($trimestre) > 0 )
    {
      $emplois =Emplois_temps::with(['prof'=> function($q)
    {
      $q->with('employe');
    }])->with('groupe','salle','jour','centre','module')
    ->where('prof_id',$id)
    ->where('trimestre_id',$trimestre[0]->trimestre_id)
    ->orderBy('jour_id')
    ->get();
    }
    else
       $emplois='';
    

   // $jours=Jours::all();


    return compact('emplois','trimestre');
  }
  public function getEmploisByModule($id)
  {
    $trimestre=Emplois_temps::with('trimestre')->where('module_id',$id)->distinct()->get('trimestre_id');
    if( sizeof($trimestre) > 0 )
    {
      $emplois =Emplois_temps::with(['prof'=> function($q)
    {
      $q->with('employe');
    }])->with('groupe','salle','jour','centre','module')
    ->where('module_id',$id)
    ->where('trimestre_id',$trimestre[0]->trimestre_id)
    ->orderBy('jour_id')
    ->get();
    }
    else
       $emplois='';
    

   // $jours=Jours::all();


    return compact('emplois','trimestre');
  }
  public function getEmploisByCentre($id)
  {
    $trimestre=Emplois_temps::with('trimestre')->where('centre_id',$id)->distinct()->get('trimestre_id');
    if( sizeof($trimestre) > 0 )
    {
      $emplois =Emplois_temps::with(['prof'=> function($q)
    {
      $q->with('employe');
    }])->with('groupe','salle','jour','centre','module')
    ->where('centre_id',$id)
    ->where('trimestre_id',$trimestre[0]->trimestre_id)
    ->orderBy('jour_id')
    ->get();
    }
    else
       $emplois='';
    

   // $jours=Jours::all();


    return compact('emplois','trimestre');
  }
  public function getEmploisByGroupe()
  {
    	//return Emplois_temps::withJours()->with('groupe','salle')->where('groupe_id',1)->orderBy('jour_id')->get();
     /* $emplois =Emplois_temps::with(['prof'=> function($q)
      {
          $q->with('employe')->get();
        }],'groupe','salle','jour')->where('groupe_id',1)->orderBy('jour_id')->get();*/

        return view('Emplois.ByGroupe');
      }
      public function getGroupeByCentre($id)
      {
       return Groupe::where('centre_id',$id)->get();
     }
     public function createEmplois()
     {

       $jours=Jours::all();
       $salle=Salle::all();
       $prof=Professeur::with('employe')->get();
       return view('Emplois.CreateEmplois',compact('prof','jours','salle'));
     }
     public function EmploieCreate(Request $request)
     {
 //return $request->all();
       for ($i=0; $i <sizeof($request->jours) ; $i++) 
       { 
        $emplois= New Emplois_temps;
        $emplois->groupe_id=$request->groupe;
        $emplois->trimestre_id=$request->trimestre;
        $emplois->heure_debut=$request->heureD[$i];
        $emplois->heure_fin=$request->heureF[$i];
        $emplois->prof_id=$request->prof[$i];
        $emplois->salle_id=$request->salles[$i];
        $emplois->jour_id=$request->jours[$i];
        $emplois->centre_id=$request->centre;
        $emplois->module_id=$request->modules[$i];
        $emplois->save();
      }

      session()->put('success','emplois du temps pour le groupe  : '.Groupe::find($request->groupe)->nom_groupe.'  est bien ajouter');
      return redirect('Emplois_Temps');



    }
    function getEmploisByTrimestreByGroupe($t,$g)
    {
      $emplois =Emplois_temps::with(['prof'=> function($q)
      {
        $q->with('employe');
      }])->with('groupe','salle','jour','module')
      ->where('groupe_id',$g)
      ->where('trimestre_id',$t)
      ->orderBy('jour_id')
      ->get();
      $trimestre=Trimestre::find($t);

      return compact('trimestre','emplois');
    }
      function getEmploisByTrimestreByProf($t,$p)
    {
      $emplois =Emplois_temps::with(['prof'=> function($q)
    {
      $q->with('employe');
    }])->with('groupe','salle','jour','module','centre')
      ->where('prof_id',$p)
      ->where('trimestre_id',$t)
      ->orderBy('jour_id')
      ->get();
      $trimestre=Trimestre::find($t);
      return compact('trimestre','emplois');
    }
        function getEmploisByTrimestreByModule($t,$m)
    {
      $emplois =Emplois_temps::with(['prof'=> function($q)
    {
      $q->with('employe');
    }])->with('groupe','salle','jour','module','centre')
      ->where('module_id',$m)
      ->where('trimestre_id',$t)
      ->orderBy('jour_id')
      ->get();
      $trimestre=Trimestre::find($t);
      return compact('trimestre','emplois');
    }
          function getEmploisByTrimestreByCentre($t,$c)
    {
      $emplois =Emplois_temps::with(['prof'=> function($q)
    {
      $q->with('employe');
    }])->with('groupe','salle','jour','module','centre')
      ->where('centre_id',$c)
      ->where('trimestre_id',$t)
      ->orderBy('jour_id')
      ->get();
      $trimestre=Trimestre::find($t);
      return compact('trimestre','emplois');
    }
  /*       date("m",strtotime(Trimestre::find(1)->date_debut));
      $month=date('m');
  return $trimestre_courant=Trimestre::whereBetween($month,
                [date("m",strtotime('date_debut'),date("m",strtotime('date_fin')])->get();
      $emplois =Emplois_temps::with(['prof'=> function($q)
      {
          $q->with('employe');
      }])->with('groupe','salle','jour')
         ->where('groupe_id',$id)
         ->orderBy('jour_id')
         ->get();
      $trimestre=Emplois_temps::with('trimestre')->where('groupe_id',$id)->distinct()->get('trimestre_id');
      $jours=Jours::all();*/

    }
