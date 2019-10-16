<?php
namespace App\Gestion;
use Illuminate\Http\Request;
use App\Http\Requests\EmployePostRequest;
use App\Http\Requests\EmployeUpdateRequest;
use App\Employe;
use App\Centre;
use App\Salaire;
use App\Absence;
use Illuminate\Support\Facades\Storage;
/**
 * 
 */
class EmployerImpl implements EmployerInterface
{
	
	public function AddEmployer(EmployePostRequest $request,$fonction)
	{
		$employe =new Employe ;
		$employe->prenom=$request->prenom;
		$employe->nom=$request->nom;
		if($fonction=='Professeur')
			$employe->fonction=$fonction;
		else
			$employe->fonction =$request->fonction;

		$employe->sex =$request->sex;
		$employe->email =$request->email;
		$employe->date_naissance =$request->date_naissance;
		$employe->adresse =$request->adresse;
		$employe->salaire =$request->salaire;
		$employe->devise =$request->devise;
		$employe->Tel_mobile =$request->mobile;
		$employe->Type =$request->Type;
		$employe->path_Cv = $request->cv ? $request->file('cv')->store('public') : null;
		$employe->path_contrat = $request->contrat ? $request->file('contrat')->store('public') : null;
		$employe->path_diplomes = $request->diplomes ? $request->file('diplomes')->store('public') : null;
		$employe->Tel_fixe =$request->fixe;
		$employe->date_affectation =$request->date_affectation;
		$employe->save();
		$employe->centre()->sync($request->centre);
		return $employe;
	}
	public function UpdateEmployer(EmployeUpdateRequest $request,$fonction,$employe)
	{
		$employe = Employe::findOrfail($employe);
		$employe->prenom=$request->prenom;
		$employe->nom=$request->nom;
		if ($fonction=='Professeur') {
			$employe->fonction=$fonction;
		}
		else
			$employe->fonction =$request->fonction;

		$employe->sex =$request->sex;
		$employe->email =$request->email;
		$employe->date_naissance =$request->date_naissance;
		$employe->adresse =$request->adresse;
		$employe->centre()->sync($request->centre);
		$employe->salaire =$request->salaire;
		$employe->Type =$request->Type;
		$employe->devise =$request->devise;
        //supp de l existant 
		if ($request->cv ) {
			Storage::delete($employe->path_Cv);
			$employe->path_Cv = $request->file('cv')->store('public') ;
		}
		if ($request->contrat) {
			Storage::delete($employe->path_contrat);
			$employe->path_contrat =  $request->file('contrat')->store('public');
		}
		if($request->diplomes){
			Storage::delete($employe->diplomes);
			$employe->path_diplomes =  $request->file('diplomes')->store('public') ;           
		}

        //
		$employe->Tel_mobile =$request->Tel_mobile;
		$employe->Tel_fixe =$request->Tel_fixe;
		$employe->sex =$request->sex;
		$employe->date_affectation =$request->date_affectation;
		$employe->update();

		return $employe;
	}
	public function DeleteEmployer($employe)
	{
		$employe = Employe::findOrfail($employe);
		$employe->centre()->detach();
		switch ($employe->fonction) {
			case 'Responsable_commerciale':
			$employe->commericale_interne()->delete();
			$employe->delete();
			$employe->user()->delete();
			break;
			case 'Responsable':
			$employe->responsable()->delete();
			$employe->delete();
			$employe->user()->delete();
			break;
			case 'Responsable':
			$employe->commericale_interne()->delete();
			$employe->delete();
			$employe->user()->delete();
			break;
			case 'Responsable_Pedagogique':
			$employe->responsable_technique()->delete();
			$employe->delete();
			$employe->user()->delete();
			break;
			
			default:
				# code...
			break;
		}
		

		

	}
	public function AddAbsences(Request $request)
	{
		$absence = new Absence;
		$absence->heure_debut=$request->heure_debut;
		$absence->motif=$request->motif;
		$absence->heure_fin=$request->heure_fin;
		$absence->date=$request->date;
		$absence->type=$request->type;
		$absence->employe_id=$request->id;
		$absence->save();
		return $absence;
	}
}


?>