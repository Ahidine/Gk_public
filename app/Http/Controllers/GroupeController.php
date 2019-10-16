<?php

namespace App\Http\Controllers;

use App\Module;
use App\Groupe;
use App\Trimestre;
use App\Niveau;
use App\Centre;
use App\Etude;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \DB;
use  App\Gestion\GroupeInterface;

class GroupeController extends Controller
{


    protected  $groupeImp;

    public function __construct(GroupeInterface $groupeImp)
    {
        $this->groupeImp = $groupeImp;
    }

    public function index()
    {
        //
        $groupe= Groupe::withCount('eleves')->with('niveau','trimestre','module','centre')->get();
        $etude = Etude::with('trimestre','module')->orderBy('groupe_id')->get();
        $i=0;
          //Etude::with('trimestre','module','etude')->where('groupe_id',35)->get();

        return view('Groupes.index',compact('groupe','etude','i'));

    }
    public function getPlanningByGroupe($id)
    {
      return   $etude = Etude::with('trimestre','module')->where('groupe_id',$id)->get();
    }
    public function getGroupeByThowIdWithCounting($id_centre,$id_niveau)
    {

   // return Groupe::with('eleves')->get();
       return $groupes=Groupe::withCount('eleves')
       ->where('centre_id','=',$id_centre)
       ->where('niveau_id','=',$id_niveau)
       ->get();

   }

   public function create()
   {
        //
    $modules = Module::all();
    $trimestres = Trimestre::all();
    $niveaux =Niveau::all();
    $centres=Centre::all();
    return view('Groupes.AddGroupe',compact('modules','trimestres','niveaux','centres'));
    }
    public function calculeDate($mydate,$week)
    {
        $weeks=12+$week;
       return $date=date('Y-m-d', strtotime(base64_decode($mydate).' + '.$weeks.' week'));
       
    }


public function store(Request $request)
{
 $request->all();
   $groupe =$this->groupeImp->AddGroupe($request);
   $this->groupeImp->AddModulesTrimestres($request,$groupe);
   session()->put('success','groupe : '.$groupe->nom_groupe.' est bien ajouté');

   return redirect('Groupe');
}

public function show($id)
{
        //
}

public function edit($id)
{
        //
    $groupe= Groupe::with('module','trimestre','niveau','centre')->find($id);
    $ids_modules= $groupe->module->pluck('id');
    $ids_trimestres= $groupe->trimestre->pluck('id');
    $niveaux= Niveau::all();
    $trimestres =Trimestre::all();
    $modules= Module::all();
    $centres=Centre::all();
    return view('Groupes.editGroupe',compact('ids_modules','groupe','niveaux','modules','ids_trimestres','trimestres','centres'));
}

public function update(Request $request, $id)
{
        //
     $request->all();
    $groupe=$this->groupeImp->UpdateGroupe($request,$id);
    $this->groupeImp->UpdateModulesTrimestres($request,$groupe);
    session()->put('warning','groupe : '.$groupe->nom_groupe.' est bien modifié');

    return redirect('Groupe');

}

public function destroy($groupe)
{
        //
    $groupe=$this->groupeImp->delete($groupe);
  //  session()->put('error','groupe : '.$groupe->nom_groupe.' est bien supprimé');
    return 0;
}
public function getGroupeByThowID($id_centre,$id_niveau)
{
    return Groupe::where('centre_id','=',$id_centre)->where('niveau_id','=',$id_niveau)->get();
}
public function getGroupeByID($id)
{
    return Groupe::find($id);
}
}
