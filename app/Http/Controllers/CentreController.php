<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Centre;
use App\Ville;
use App\Pays;
use App\Module;
use Auth;
use App\Responsable;
class CentreController extends Controller
{

    public function index()
    {
       $centres = Centre::with('ville','responsable')
         ->withCount('eleve')
         ->withCount(['employe'=> function($q)
      {
          $q->where('fonction','Professeur');
      }])->get(); 

        return view('Centres.index',compact('centres'));
    }

    public function create()
    {
        $responsables = Responsable::all();
        return view('Centres.AddCentre',compact('responsables'));

    }
    public function getPays()
    {
        return Pays::all();
    }
    public function getVilles($id)
    {
        return Ville::where('pays_id','=',$id)->get();
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'nom' => 'required|max:255',
            'adresse' => 'required',
            'ville' => 'required',
            'type'=>'required'
        ]);
        $centre=New Centre;
        $centre->nom=$request->nom;
        $centre->adresse=$request->adresse;
        $centre->ville_id=$request->ville;
        $centre->responsable_id= $request->responsable;
        $centre->type=$request->type;
        $centre->save();
        session()->put('success','centre : '.$centre->nom.' est bien ajouté');
        return redirect('centre');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //les info de centre
         $centre=Centre::with('ville','responsable')->where('id','=',$id)->first();
         $paysCentre = Pays::find($centre->ville->pays_id);
        // les info des pays et les responsables au cas s'il veut modifier
        $paysVille = Ville::where('pays_id','=',$paysCentre->id)->get();
        $pays=Pays::all();
        $responsables = Responsable::all();
        $centre->ville;
        return view('centres.edit',compact('centre','paysCentre','responsables','paysVille','pays'));
    }


    public function update(Request $request, $id)
    {
        //
        $centre= Centre::find($id);
        $centre->nom=$request->nom;
        $centre->adresse=$request->adresse;
        $centre->ville_id=$request->ville;
        $centre->responsable_id= $request->responsable;
        $centre->type=$request->type;
        $centre->update();
        session()->put('warning','centre : '.$centre->nom.' est bien modifié');
        return redirect('centre');
    }


    public function destroy($id)
    {
        //
        $centre=Centre::findOrFail($id);
        $data= Centre::withCount('eleve')->withCount('employe')->find($id);
        if ($data->employe_count>0 || $data->eleve_count>0) {
            session()->put('error','Le centre : '.$centre->nom.' contient des professeurs et/ou des élèves impossible d etre supprimer merci de refaire l affectation des élèves ou/et des professeurs');
            return redirect('centre');
            # code...
        }
        
        $centre->niveau()->delete();
        $centre->delete();
        session()->put('error','centre : '.$centre->nom.' a été supprimer');
        return redirect('centre');
    }
        public function getCentresByVille($id)
    {
        //
        $centre=Centre::where('ville_id', '=', $id)->get();
        return $centre;
    }
        public function getCentres($id)
    {
        //
        $centre=Centre::findOrFail($id);
        return $centre;
    }
    public function getAllCentres()
    {
        return Centre::all();
    }
}
