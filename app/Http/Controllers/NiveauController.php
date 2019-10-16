<?php

namespace App\Http\Controllers;

use App\Niveau;
use App\Centre;
use App\Groupe;
use App\Module;
use Session;

use Illuminate\Http\Request;
use  App\Gestion\NiveauInterface;

class NiveauController extends Controller
{

    protected  $niveauImp;

    public function __construct(NiveauInterface $niveauImp)
    {
        $this->niveauImp = $niveauImp;
    }
    
    public function index()
    {
        //
      $niveau = Niveau::all(); 
      return view('Niveaux.index',compact('niveau'));

  }

  public function create()
  {
        //
    $centres = Centre::all();

    $modules = Module::all();
    return view('Niveaux.AddNiveau',compact('centres','modules'));

  }

public function store(Request $request)
{
        //
    $niveau=$this->niveauImp->AddNiveau($request);
    $this->niveauImp->AddModules($request,$niveau);
    $this->niveauImp->AddPrix($request,$niveau);
    session()->put('success','niveau : '.$niveau->type.' est bien ajouté');

    return redirect('Niveau');
}

public function show(Niveau $niveau)
{
        // 
}

public function edit($id)
{
        //
   $niveau  = Niveau::with('centre','module')->where('id','=',$id)->first();
    $ids= $niveau->module->pluck('id');
       //  $niveau->centre->first()->pivot->prix;

       //  $ids_centres = $niveau->centre->pluck('id')->toArray();
       //  $prix = $niveau->centre->pluck('pivot.prix')->toArray();
      //   $devise = $niveau->centre->pluck('pivot.devise')->toArray();
   $centres = Centre::all();
   $modules = Module::all();

   return view('Niveaux.editNiveau',compact('centres','niveau','modules','ids'));
}
public function getCentresId($id)
{
    $niveau =Niveau::with('centre')->where('id','=',$id)->first();
    $ids_centres = $niveau->centre->pluck('id')->toArray();
    return  $ids_centres ;
}

public function update(Request $request,$id)
{
        // 
    $niveau=$this->niveauImp->UpdateNiveau($request,$id);
    $this->niveauImp->UpdateModule($request,$niveau,$id);
    $this->niveauImp->UpdatePrix($request,$niveau);
    session()->put('warning','niveau : '.$niveau->type.' est bien modifié');    
    return redirect('Niveau');
}

public function destroy($id)
{
        //
    $niveau=$this->niveauImp->delete($id);
    session()->put('error','niveau : '.$niveau->type.' est bien supprimé');
    return redirect('Niveau');
}
public function getNiveauByID($id)
{
       /* $niveau = Niveau::with(['centre'=>function($query) use($id)
          {
            $query->where('centre_id' , '=', $id);
        }])->get();*/
        return Niveau::all();
    }
public function HelperPutNiveau($niveau,$centre)
{
  $niv=Niveau::find($niveau);
  $NC=$niv->centre()->where('centre_id',$centre)->first();
  $prix= $niv->centre()->where('centre_id',$centre)->first()->pivot->prix;
  session(['prix' => $prix]);
  $prix=session('prix');
  return  compact('prix','NC') ;
 

}
public function HelperGetNiveau()
{
   return session('prix');
}
}
