<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Centre;
use App\Salaire;
use \DB;
use App\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Gestion\AdminInterface;
use App\Http\Requests\EmployePostRequest;
use App\Http\Requests\EmployeUpdateRequest;
use App\Gestion\EmployerInterface;

class EmployeController extends Controller
{

    protected $employeImpl;
    function __construct(EmployerInterface $employeImpl)
    {
        $this->employeImpl=$employeImpl;
    }

    public function index()
    {
        //
      $employe = Employe::with('centre','centre')->where('fonction','not like','Professeur')->get();
        return view('Employe.index', compact('employe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       $centres = Centre::all();
       return view('Employe.AddEmploye',compact('centres'));

   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployePostRequest $requestEmpl , AdminInterface $nvUser)
    {
        //
         $requestEmpl->all();
         $employer=$this->employeImpl->AddEmployer($requestEmpl,'normal');
         $nvUser->AddUser($employer,  $employer->fonction);

        session()->put('success','employe : '.$employer->nom.' '. $employer->prenom.' est bien ajouté');
        return redirect('Employe');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return Employe::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit($employe)
    {
        //
        $employe= Employe::with('centre')->find($employe);
        $id_centres= $employe->centre->pluck('id');
        $centres=Centre::where('type',1)->get();
        return view('Employe.EditEmploye',compact('employe','centres','id_centres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeUpdateRequest $request ,$employe)
    {
        
        $employer=$this->employeImpl->UpdateEmployer($request,'normal',$employe);
        session()->put('warning','employe : '.$employer->nom.' '. $employer->prenom.' est bien modifé');
        return redirect('/Employe');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy($employe)
    {
        //
        $this->employeImpl->DeleteEmployer($employe);
      //  session()->put('error','employe : '.$employe->nom.' '. $employe->prenom.' est bien supprimé');
        return $employe;

    }
    public function getSalaire($employe)
    {
     $emp = Employe::findOrfail($employe);
     $salaires=Salaire::where('employe_id','=',$employe)->whereYear('date_echeance', date('Y'))->get();
     return compact('salaires','emp');

 }
 public function getSalaireByYear($employe,$year)
 {
     $emp = Employe::findOrfail($employe);
     $salaires=Salaire::where('employe_id','=',$employe)->whereYear('date_echeance',$year )->get();
     return compact('salaires','emp');

 }
 public function getAbsences($employe)
 {
   $emp = Employe::findOrfail($employe);
   $absences = Absence::where('employe_id','=',$employe)->whereYear('date', date('Y'))->get();
   return compact('absences','emp');

}
public function getAbsencesByYear($id,$year)
{   

  $absences = Absence::where('employe_id','=',$id)
  ->whereYear('date', $year)
  ->get();
  $emp = Employe::findOrfail($id);
  return compact('absences','emp');

}
public function ListePrAbsences()
{
    $villes = DB::table('ville')
    ->join('pays', 'pays.id', '=', 'ville.pays_id')
    ->where('pays.nom','Belgique')
    ->select('ville.*')
    ->get();
    $employes =$this->getAllEmployes();
    return view('Employe.absences',compact('villes','employes'));
}
public function getAllEmployes()
{
    return Employe::with('centre')->get();
}
public function getListeByCentre($centre)
{
    return Employe::with('centre')->where('centre_id',$centre)->get();
}
public function getAbsencesEmploye($id)
{
   $absences= Absence::where('employe_id',$id)
   ->whereYear('date', date('Y'))
   ->whereMonth('date', date('m'))
   ->get();
   $employe=Employe::find($id);
   return compact('absences','employe');
}
public function getAbsenceWorkerByYearMonth($id,$year,$month)
{
    $absences= Absence::where('employe_id',$id)
    ->whereYear('date', $year)
    ->whereMonth('date', $month)
    ->orderBy('date')
    ->get();
    $employe=Employe::find($id);
    return compact('absences','employe');
}

public function makeAbsence(Request $request)
{   

  $absence=$this->employeImpl->AddAbsences($request);
//  $employe= Employe::findOrfail($request->id);


  return $absence;

}
public function getFile($file)
{

    return Storage::download(base64_decode($file));
}
}

