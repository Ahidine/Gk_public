<?php

namespace App\Http\Controllers;

use App\Professeur;
use App\Jours;
use App\Employe;
use App\Diplome;
use App\Salle;
use App\User;
use App\Ville;
use App\Centre;
use App\Salaire_prof;
use App\Http\Requests\EmployePostRequest;
use App\Http\Requests\EmployeUpdateRequest;
use App\Emplois_temps;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Gestion\AdminInterface;
use App\Gestion\EmployerInterface;

//date == null et calendrie == null

class ProfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $employeImpl;
    function __construct(EmployerInterface $employeImpl)
    {
        $this->employeImpl=$employeImpl;
    }
    public function index()
    {
        //
    $Pr= Professeur::with('diplomes','emplois_temps')
       ->with(['employe'=> function($q)
      {
          $q->with('centre');
      }])->get();
       return view('Professeur.index',compact('Pr'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $centres=Centre::where('type',1)->get();
        return view('Professeur.AddProf',compact('centres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployePostRequest $request, AdminInterface $AdminImp)
    {
        //       

        $employe=$this->employeImpl->AddEmployer($request,'Professeur');
        $employe->setAttribute('nombreSeance',$request->nombreSeance);  
        $employe->setAttribute('anciennete',$request->anciennete);  
        $prof=$AdminImp->AddUser($employe,'Professeur');


        for ($i=0; $i < sizeof($request->diplome) ; $i++)
        { 
            $diplome = new Diplome;
            $diplome->intitule=$request->diplome[$i];
            $diplome->ecole=$request->ecole[$i];
            $diplome->specialite=$request->specialite[$i];
            $diplome->date_obtention=$request->date_obtention[$i];
            $diplome->prof_id=$prof->id;
            $diplome->save();
        }

            /*  for ($i=0; $i < sizeof($request->groupes) ; $i++)
            { 
                $ET = new Emplois_temps;
                $ET->groupe_id=$request->groupes[$i];
                $ET->jour_id=$request->jours[$i];
                $ET->salle_id=$request->salles[$i];
                $ET->heure_debut=$request->heureD[$i];
                $ET->heure_fin=$request->heureF[$i];
                $ET->prof_id=$prof->id;
                $ET->save();
            }*/
            session()->put('success','professeur : '.$employe->nom.' '. $prof->prenom.' est bien ajouté');
            return redirect('Prof');



        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professeur  $professeur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return $id;

     //return $salaires=Salaire_prof::where('prof_id','=',$id)->whereYear('date_echeance', date('Y'))->get();
     return  $prof= Professeur::with('diplomes')
     ->with(['employe'=> function($q)
      {
          $q->with('centre');
      }])->find($id);
 }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professeur  $professeur
     * @return \Illuminate\Http\Response
     */
    public function edit($professeur)
    {
        //
        
        $Pr= $this->show($professeur);
        $id_centres=$Pr->employe->centre->pluck('id');

        /*$PaysVille = DB::table('centre')
        ->select('ville.id as ville_id','ville.nom as ville','pays.id as pays_id','pays.nom as pays','centre.nom as centre','centre.id as centre_id')
        ->join('ville', 'centre.ville_id', '=', 'ville.id')
        ->join('pays', 'pays.id', '=', 'ville.pays_id')
        ->where('centre.id','=',$Pr->centre->id)
        ->get();*/

       // $villes=Ville::where('pays_id','=',$PaysVille[0]->pays_id)->get();
        $centres=Centre::where('type',1)->get();
       // $jours=Jours::all();
       //$salles = Salle::all();

        return view('Professeur.editProf',compact('Pr','id_centres','centres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professeur  $professeur
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeUpdateRequest $request,$professeur)
    {
        //
        // return $request->all();
        $prof =Professeur::with('employe')->find($professeur);
        $employe =$this->employeImpl->UpdateEmployer($request,'Professeur',$prof->employe_id);

        $prof->nombreSeance =$request->nombreSeance;
        $prof->employe_id=$employe->id;
        $prof->anciennete=$request->anciennete;
        $prof->update();

        


        if ($request->diplome) {
            Diplome::where('prof_id','=',$professeur)->delete();
            for ($i=0; $i < sizeof($request->diplome) ; $i++)
            { 
                $diplome = new Diplome;
                $diplome->intitule=$request->diplome[$i];
                $diplome->ecole=$request->ecole[$i];
                $diplome->specialite=$request->specialite[$i];
                $diplome->date_obtention=$request->date_obtention[$i];
                $diplome->prof_id=$prof->id;
                $diplome->save();        
            }
        }
        
    /*            
     $Emp_T =Emplois_temps::where('prof_id','=',$professeur)->delete();
    // return $request->groupes;
     if ($request->groupes) {
         # code...

        for ($i=0; $i < sizeof($request->groupes) ; $i++)
            { 

                        $ET = new Emplois_temps;
                        
                        $ET->jour_id=$request->jours[$i];
                        $ET->salle_id=$request->salles[$i];
                        $ET->heure_debut=$request->heureD[$i];
                        $ET->heure_fin=$request->heureF[$i];
                        $ET->groupe_id=$request->groupes[$i];
                        $ET->prof_id=$prof->id;
                        $ET->save();
                       
            }
        }*/


        session()->put('warning','professeur : '.$prof->employe->nom.' '. $prof->employe->prenom.' est bien modifié');
        return redirect('Prof');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professeur  $professeur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $prof = Professeur::findOrfail($id);

        $profuser=User::where('id','=',$prof->user_id);
        if ($profuser) {
            $profuser->delete();
        }
        $diplome=Diplome::where('prof_id','=',$id)->delete();
        $prof->emplois_temps()->update(['prof_id'=> null]);

        $prof->delete();
        Employe::find($prof->employe_id)->delete();
        session()->put('error','professeur : '.$prof->nom.' '. $prof->prenom.' est bien supprimé');
        return $prof;
    }



    public function getSalaire($id)
    {
     $Pr = Professeur::findOrfail($id);
     $salaires=Salaire_prof::where('prof_id','=',$id)->whereYear('date_echeance', date('Y'))->get();
     return compact('salaires','Pr');

 }
 public function getSalaireByYear($id,$year)
 {
     $Pr = Professeur::findOrfail($id);
     $salaires=Salaire_prof::where('prof_id','=',$id)->whereYear('date_echeance', $year)->get();
     return compact('salaires','Pr');

 }
 public function getAllProf()
 {
    return Professeur::with('employe')->get();
 }
}
