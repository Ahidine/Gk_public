<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emplois_temps;
use App\Groupe;
use App\Jours; 
use App\Professeur;
use App\Salle;
use App\Employe;
use App\Centre;
use App\Trimestre;
use \DB;
use App\Etude;
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

  return view('Emplois.ByGroupe');
}
public function getGroupeByCentre($id)
{
 $groupe = Groupe::where('centre_id',$id)->get();
 $prof = DB::table('professeur as p')
 ->select('p.id as id_prof', 'em.*')
 ->join('employe as em', 'em.id', '=', 'p.employe_id')
 ->join('employe_centre as c', 'c.employe_id', '=', 'em.id')
 ->where('c.centre_id',$id)
 ->get();
 $salles = Salle::where('centre_id',$id)->get();
 $jours=Jours::all();

 

 return compact('groupe','prof','salles','jours');

}
public function createEmplois()
{

 return view('Emplois.CreateEmplois');
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
function editEmploisTemps($id)
{
  $groupe = Groupe::find($id);
  return view('Emplois.EditEmplois',compact('groupe'));
}
function update(Request $request)
{
 $request->all();
 Emplois_Temps::where('groupe_id',$request->groupe)->where('trimestre_id',$request->trimestre)->delete();
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
session()->put('success','emplois du temps pour le groupe  : '.Groupe::find($request->groupe)->nom_groupe.'  est bien modifier');
return redirect('Emplois_Temps');

}

}
