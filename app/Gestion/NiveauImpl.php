<?php
/**
 * 
 */
namespace App\Gestion;
use App\Niveau;
use App\Centre;
use App\Groupe;
use App\Module;
use Illuminate\Http\Request;

class NiveauImpl implements NiveauInterface
{


	public function AddNiveau(Request $request)
	{
		$niveau=New Niveau;
        $niveau->type=$request->type;
        $niveau->min_age=$request->min_age;
        $niveau->max_age=$request->max_age;
        $niveau->save(); 
        return $niveau;

	}
	public function AddModules(Request $request,$niveau)
	{
		if ($request->module_id) 
		{
 
          /*   foreach ($request->module_id as $id_M)
              {
	             $m=Module::find($id_M) ;
	             $m->niveau()->associate($niveau->id);
	             $m->save();
        	  }*/
        	  $niveau->module()->sync($request->module_id);


        }

	}
	public function AddPrix(Request $request,$niveau)
	{
		$prix=$request->prix;
        $devise=$request->devis;
        $c=$request->centres;
        for ($i=0; $i < sizeof($c) ; $i++) 
        { 
            $niveau->centre()->attach($c[$i], array('prix' => $prix[$i],'devise'=>$devise[$i]));
        }

	}
	public function UpdateModule(Request $request,$niveau,$id)
	{

        $niveau->module()->update(['niveau_id'=> null]);
        if ($request->module_id) 
       {

		      /* foreach ($request->module_id as $id_M) 
		        {
		             $m=Module::find($id_M) ;
		             $m->niveau()->associate($id);
		             $m->save();
		        }*/
		    $niveau->module()->sync($request->module_id);
        }

	}
	public function UpdatePrix(Request $request,$niveau)
	{

        $c=$request->centres;
        $prix=$request->prix;
        $devise=$request->devis;
        $niveau->centre()->detach();
        for ($i=0; $i < sizeof($c) ; $i++) { 
            # code...
            $niveau->centre()->attach($c[$i], array('prix' => $prix[$i],'devise'=>$devise[$i]));
        }
	}
	public function delete($id)
	{
		$niveau= Niveau::findOrFail($id);
        $niveau->centre()->detach();
         Module::where('niveau_id','=',$id)->update(['niveau_id'=> null]);
         Groupe::where('niveau_id','=',$id)->update(['niveau_id'=> null]);
        $niveau->delete();
        return $niveau;
	}
	public function UpdateNiveau(Request $request,$id)
	{
			$niveau=Niveau::findOrFail($id);
		    $niveau->type=$request->type;
		    $niveau->min_age=$request->min_age;
		    $niveau->max_age=$request->max_age;
		    $niveau->update(); 
		    return $niveau;
	}
}
