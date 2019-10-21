<?php
namespace App\Gestion;
use Illuminate\Http\Request;
use App\Eleve;
use App\Groupe;
use App\Centre;
use Carbon\Carbon;
use App\Niveau;
use App\Paiement;
use App\Parents;
use App\Http\Requests\ElevePostRequest;
use \DB;
use App\Absence;

 /**
  * 
  */
 class EleveImpl implements EleveInterface
 {
 	
 	public function AddPreinscrit(Request $request)
 	{
 		$request->validate([
 			'nom' => 'required|max:30',
 			'prenom' => 'required|max:30',
 			'date_naissance' => 'date',
 			'numero' => 'required|max:30',
 			'comment' => 'required',
 			'centre' => 'required',
 		]);
 		$eleve= new Eleve();
 		$eleve->nom=$request->nom;
 		$eleve->prenom=$request->prenom;
 		$eleve->age=$request->age;
 		$eleve->numero=$request->numero;
 		$eleve->comment=$request->comment;
 		$eleve->centre_id=$request->centre;
 		$eleve->path_photo='null';
 		$eleve->lieu_naissance='null';
 		$eleve->sex=$request->sex;
 		$eleve->nationalite='null';
 		$eleve->adresse='null';
 		$eleve->Est_Inscrit=0;
 		$eleve->save();
 		return $eleve;
 	}
 	public function AddInscrit(Request $request)
 	{
 		$eleve=Eleve::find($request->eleve);
 		$eleve->nom=$request->nom;
 		$eleve->prenom=$request->prenom;
 		$eleve->age=$request->age;
 		$eleve->sex=$request->sex;
 		$eleve->nationalite=$request->nationalite;
 		$eleve->adresse=$request->adresse;
 		$eleve->Est_Inscrit=1;
 		$eleve->groupe_id=$request->groupe_id;
 		if($request->commerciale_interne)
 			$eleve->responsable_commerciale_interne_id=$request->commerciale_interne;
  		if($request->commerciale_externe)
 			$eleve->responsable_commerciale_interne_id=$request->commerciale_externe;

 		$eleve->update();
 		return $eleve;
 	}
 	public function AddParent(Request $request,$eleve)
 	{
 		$pere = New Parents;
 		$pere->nom_complet=$request->pere_nom;
 		$pere->type_parite=1;
 		$pere->tel_mobile=$request->mobile_pere;

                
 		if ($request->fixe) {
 			$pere->tel_fixe==$request->fixe;
 		}
 		else
 			$pere->email=null;
        
 		if ($request->has('email_pere')) {
 			$pere->email=$request->email_pere;
 		}
 		else
 			$pere->email=null;
 		
 		$pere->adresse=$request->adresse1;
 		$pere->save();

 		$mere = New Parents;
 		$mere->nom_complet=$request->mere_nom;
 		$mere->type_parite=0;
 		$mere->tel_mobile=$request->mobile_mere;
 		if ($request->fixe) {
 			$mere->tel_fixe==$request->fixe;
 		}
 		else
 			$pere->email=null;
        
 		if ($request->has('email_mere')) {
 			$mere->email=$request->email_mere;
 		}
 		else
 			$pere->email=null;
 		
 		$mere->adresse=$request->adresse1;
 		$mere->save();

 		$eleve->parents()->sync([$mere->id,$pere->id]);
 		return $eleve;

 	}
 	public function AddPaiement(Request $request)
 	{
 		$length= sizeof($request->montant);
 		if($length>0)
 		{
 			for ($i=0; $i <$length ; $i++) { 
 				$paiement = New Paiement;
 				$paiement->montant=$request->montant[$i];
 				$paiement->devise='€';
 				if (isset($request->etat[$i]) && $request->etat[$i]==($i+1)) {
 					$paiement->etat=1;
 				}
 				else
 					$paiement->etat=0;

 				$paiement->date_reg=$request->date_reg[$i];
 				$paiement->modalite=$request->modalite;
 				$paiement->mode_paiement=$request->mode_paiement[$i];
 				$paiement->niveau_id=$request->niveau;
 				$paiement->eleve_id=$request->eleve;
 				$paiement->save();
 			}
 		}
 		return 0;

 	}
 	public function GetListeInscrit()
 	{
 		$eleve = DB::table('eleve as e')
 		->select('g.nom_groupe', 'n.type','c.nom as centre_nom','e.*','ri.nom as resInt','re.nom as resExt')
 		->join('groupe as g', 'g.id', '=', 'e.groupe_id')
 		->join('niveau as n', 'n.id', '=', 'g.niveau_id')
 		->join('centre as c', 'c.id', '=', 'e.centre_id')
 		->leftjoin('responsable_commerciale_interne as ri', 'ri.id', '=', 'e.responsable_commerciale_interne_id')
 		->leftjoin('responsable_commerciale_externe as re', 're.id', '=', 'e.responsable_commerciale_externe_id')
 		->where('e.Est_Inscrit',1)
 		->get();
 		return $eleve;
 	}

 	public function getInfo($id)
 	{
 		$eleve_info= Eleve::with('parents')->where('id','=',$id)->first();
 		$eleve_paiement= Paiement::where('eleve_id','=',$id)->whereYear('date_reg', Date('Y'))->get();
 		return compact('eleve_info','eleve_paiement');
 	}
 	public function getPaiementByYear($id,$year)
 	{
 		return $eleve_paiement= Paiement::where('eleve_id','=',$id)->whereYear('date_reg', $year)->get();
 	}
 	public function getAbsencesByYearByMonth($year,$month,$id)
 	{
 		    $absences= Absence::where('eleve_id',$id)
		    ->whereYear('date', $year)
		    ->whereMonth('date', $month)
		    ->get();
		    return $absences;
 	}
 	public function AddAbsenceForStudent(Request $request)
 	{
 		  $absence = new Absence;
		  $absence->heure_debut=$request->heure_debut;
		  if(!empty($request->motif))
		  $absence->motif=$request->motif;
		  else
		  $absence->motif='none';

		  $absence->heure_fin=$request->heure_fin;
		  $absence->date=$request->date;
		  $absence->type='Eleve';
		  $absence->eleve_id=$request->id;
		  $absence->save();
		  $eleve= Eleve::findOrfail($request->id);	
 	}
 }
