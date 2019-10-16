<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eleve;
use App\Groupe;
use App\Centre;
use Carbon\Carbon;
use App\Niveau;
use App\Paiement;
use App\Parents;
use App\Ville;
use App\Absence;
use App\Http\Requests\ElevePostRequest;
use \DB;
use  App\Gestion\EleveInterface;
use App\Gestion\AdminInterface;

class EleveController extends Controller
{
    protected  $eleveImp;

    public function __construct(EleveInterface $eleveImp)
    {
        $this->eleveImp = $eleveImp;
    }
    function home()
    {

        return view('Eleve.Bienvenu');
    }

    public function index()
    {


        return view('Eleve.Bienvenu');
    }

    public function AddPreInsc()
    {
     $centres = Centre::all();
     return view('Eleve.AddPreinsc',compact('centres'));
 }

 public function StorePreInsc(Request $request)
 {

    $eleve= $this->eleveImp->AddPreinscrit($request);


    session()->put('success','élève : '.$eleve->nom.' est bien pré-inscrit');

    return  redirect('Eleve_pre-inscrit');
}


public function create()
{
                    //

    return view('Eleve.AddEleve');
}


public function store(Request $request,AdminInterface $admin)
{
                    //

    $eleve=$this->eleveImp->AddInscrit($request);
    $this->eleveImp->AddParent($request,$eleve);
    $this->eleveImp->AddPaiement($request);
    $admin->AddUser($eleve,'Eleve');
    session()->put('success','eleve  :'.$eleve->nom.' est bien inscrit');

    return redirect('ListeInscrits');
}


public function show($id)
{
                    // 
    $eleve = Eleve::find($id);  

    return view('Eleve.AddEleve',compact('eleve'));
}
public function getNiveau()
{
   return Niveau::all(); 
}


public function edit($id)
{
                    //
} 

public function update(Request $request, $id)
{
                    //
}


public function destroy($id)
{
                    //
    $eleve=Eleve::find($id);
    $eleve->parents()->detach();
    $eleve->paiement()->delete();
    $eleve->delete();
    $eleve->user()->delete();
    if ($eleve->Est_Inscrit) {
        return $eleve;
    }
    else
    {    
    session()->put('error','eleve  :'.$eleve->nom.' est bien supprimer');
    return redirect('Eleve_pre-inscrit');
    }

}

public function eleve_preInsc_data()
{
 $date= Carbon::now();
 $eleve= Eleve::where('Est_Inscrit','=',0)->get();
 return view('Eleve.PreInscListe',compact('date','eleve'));
}

public function ListeInscrits()
{
 $eleve = $this->eleveImp->GetListeInscrit();

 return view('Eleve.ListeInscri',compact('eleve'));
}

public function getInfo($id)
{
 return $this->eleveImp->getInfo($id);
}

public function getPaiementByYear($id,$year)
{
   return  $this->eleveImp->getPaiementByYear($id,$year);
}
public function ListeAbsences()
{

    $villes = DB::table('ville')
    ->join('pays', 'pays.id', '=', 'ville.pays_id')
    ->where('pays.nom','Belgique')
    ->select('ville.*')
    ->get();

 // $eleves=Eleve::with('centre','groupe','absences')->where('Est_Inscrit',1)->get();
    return view('Eleve.AbsencesEleve',compact('villes'));
}
public function getListeByCentre($centre)
{
    return Eleve::with('centre','groupe')->where('centre_id', $centre)->where('Est_Inscrit',1)->get();
}
public function getAbsenceStudent($id)
{

    $absences= $this->eleveImp->getAbsencesByYearByMonth(date('Y'),date('m'),$id);
    $eleve=Eleve::find($id);
    return compact('absences','eleve');
}
public function getAbsenceStudentByYearByMonth($id,$year,$month)
{
    $eleve=Eleve::find($id);
    $absences=$this->eleveImp->getAbsencesByYearByMonth($year,$month,$id);
    return compact('absences','eleve');
}
public function AddAbsenceStudent(Request $request)
{


  return $absence=$this->eleveImp->AddAbsenceForStudent($request);

}

}
