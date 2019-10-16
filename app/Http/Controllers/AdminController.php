<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
use App\Eleve;
use App\User;
use App\Centre;
use App\Groupe;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Professeur;
use App\Niveau;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Emplois_temps;
use App\Responsable_commerciale_interne;
use App\Responsable_technique;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       /* $users = DB::table('emplois_temps')
            ->join('professeur', 'users.id', '=', 'contacts.user_id')
            ->join('', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();*/
           // return 
           // Emplois_temps::with('prof','groupe','salle','jour')->where('groupe_id',1)->orderBy('jour_id')->get();
            $centres=Centre::all()->count();
            $niveau=Niveau::all()->count();
            $eleves=Eleve::where('Est_Inscrit',1)->count();
            $groupes=Groupe::all()->count();
            $professeurs=Professeur::all()->count();
            $employes=Employe::where('fonction','not like','Professeur')->count();



            return view('Admin.Bienvenu',compact('centres','niveau','eleves','groupes','professeurs','employes'));
        }

        public function create()
        {
        //

            return view('Admin.AddUser');
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function BloqueUser($id)
    {
        $user= User::find($id);
        $user->IsBlocked=1;
        $user->save();
        return $user;
    }
    public function DeBloqueUser($id)
    {
        $user=User::find($id);
        $user->IsBlocked=0;
        $user->save();
        return $user;
    }

    public function getProfUser()
    {
        return Professeur:: whereNotNull('user_id')->with('user')
        ->with(
            ['employe'=>function($q)
            {
                $q->with('centre');
            }
        ])->get();
    }
    public function getRCUser()
    {
        return Responsable_commerciale_interne::whereNotNull('user_id')
        ->with('user')
        ->with(['employe'=> function($q)
        {
          $q->with('centre');
      }])
        ->get();
    }
    public function getRPUser()
    {
        return Responsable_technique::whereNotNull('user_id')
        ->with('user')
        ->with(['employe'=> function($q)
        {
          $q->with('centre');
      }])
        ->get();
    }
    public function getEleveUser()
    {
        return Eleve::whereNotNull('user_id')->with('user','centre','parents')->get();
    }
    public function AddUser(Request $user)
    {
        $data = array(
            'nom'      =>  $user->nom,
            'prenom'   =>  $user->prenom,
            'email' =>$user->email,
            'password' =>$user->password
        );
        $nvUser=new User ;
        $nvUser->name=$user->fonction;
        $nvUser->email=$user->email;
        $nvUser->password=Hash::make($user->password);
        $nvUser->role_id=Role::where('name',$user->fonction)->first()->id;
        $nvUser->save();
        if($user->fonction =='Professeur')
        {
         $prof= Professeur::find($user->id);
         $prof->user_id=$nvUser->id;
         $prof->save();
     }
     elseif ($user->fonction=='Responsable_commerciale') 
     {
        $respo=Responsable_commerciale::find($user->id);
        $respo->user_id=$nvUser->id;  
        $repo->save();  
    }
    elseif ($user->fonction=='Eleve') 
    {
     $eleve= Eleve::find($user->id);
     $eleve->user_id=$nvUser->id; 
     $eleve->save();
 }
 elseif ($user->fonction=='Responsable_pedagogique')
 {
    $respo=Responsable_technique::find($user->id);
    $respo->user_id=$nvUser->id;
    $respo->save();
}
$nvUser->assignRole($nvUser->fonction);
Mail::to($user->email)->send(new SendEmail($data));
session()->put('success','compte de   :'.$user->nom.' est bien ajoute un email de confirmation a ere envoye a son propre email ');
return  Response()->json($nvUser);
}
}
