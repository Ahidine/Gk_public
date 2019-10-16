<?php
namespace App\Gestion;
use App\Module;
use App\Groupe;
use App\Trimestre;
use App\Niveau;
use App\Centre;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \DB;
/**
 * 
 */
class GroupeImp implements GroupeInterface
{

	public function AddGroupe(Request $request)
	{
		 $groupe = new Groupe ;
	     $groupe->nom_groupe=$request->nom_groupe;
	     $groupe->capacite =$request->capacite;
	     $groupe->niveau_id =$request->niveau;
	     $groupe->centre_id =$request->centre;
	     $groupe->save();
	     return $groupe;
	}
	public function AddModulesTrimestres(Request $request,$groupe)
	{
		for ($i=0; $i < sizeof($request->trimestre) ; $i++)
		 { 
            # code...
       		$groupe->trimestre()->attach($request->trimestre[$i], array('module_id' => $request->modules[$i]));
   		 }

	}
	public function UpdateGroupe(Request $request,$id)
	{
		$groupe=Groupe::where('id','=',$id)->first();
       $groupe->nom_groupe=$request->nom_groupe;
       $groupe->capacite =$request->capacite;
       $groupe->niveau_id =$request->niveau;
       $groupe->centre_id=$request->centre;
       $groupe->update();
       return $groupe;
	}
	public function UpdateModulesTrimestres(Request $request,$groupe)
	{
		if($groupe->trimestre())
		$groupe->trimestre()->detach();

	       for ($i=0; $i < sizeof($request->trimestre) ; $i++) 
	       { 
	            # code...
	        $groupe->trimestre()->attach($request->trimestre[$i], array('module_id' => $request->modules[$i]));
	       }
	}

	public function delete($groupe)
	{
		$groupe= Groupe::find($groupe);
        $groupe->trimestre()->detach();
        $groupe->delete();
        return $groupe;
	}
}