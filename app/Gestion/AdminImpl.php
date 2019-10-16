<?php
namespace App\Gestion;
use Illuminate\Http\Request;
use App\Employe;
use App\Eleve;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Professeur;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Emplois_temps;
use App\Responsable_commerciale_interne;
use App\Responsable_technique;
use App\Responsable;
/**
 * 
 */
class AdminImpl  implements AdminInterface
{
	
	public function AddUser($user,$fonction)
	{
		$password=str_random(10);

		if($fonction=='Eleve')
		{
			$cible= Eleve::find($user->id);
			if ($cible->parents[0]->email) {
				$user->setAttribute('email',$cible->parents[0]->email);
			}
			else
				$user->setAttribute('email',$cible->parents[1]->email);	
		}


		$data = array(
			'nom'      =>  $user->nom,
			'prenom'   =>  $user->prenom,
			'email' => $user->email,
			'password' => $password
		);





		$nvUser=new User ;
		$nvUser->name=$user->nom.' '.$user->prenom;
		$nvUser->email=$user->email;
		$nvUser->password=Hash::make($password);
		$nvUser->role_id=Role::where('name',$fonction)->first()->id;
		$nvUser->save();


		if($fonction =='Professeur')
		{
			$cible= new Professeur;
			$cible->nombreSeance=$user->nombreSeance;
			$cible->user_id=$nvUser->id;
			$cible->employe_id=$user->id;
			$cible->anciennete=$user->anciennete;
			$cible->save();
		}
		elseif ($fonction=='Responsable_commerciale') 
		{
			
			$cible= new Responsable_commerciale_interne;
			$cible->nom = $user->nom.' '.$user->prenom;
			$cible->user_id=$nvUser->id; 
			$cible->employe_id= $user->id;
			$cible->save();

		}
		elseif ($fonction=='Eleve') 
		{
			
			$cible->user_id=$nvUser->id; 
			$cible->save();

		}
		elseif ($fonction=='Responsable_pedagogique')
		{
			$cible= new Responsable_technique ;
			$cible->user_id=$nvUser->id;
			$cible->employe_id= $user->id;
			$cible->save();
		}
		elseif ($fonction=='Responsable')
		{
			$cible= new Responsable;
			$cible->user_id=$nvUser->id;
			$cible->nom=$user->nom.' '.$user->prenom;
			$cible->employe_id= $user->id;
			$cible->save();

		}
		$nvUser->assignRole($fonction);
		if($fonction=='Eleve')
			Mail::to($user->email)->send(new SendEmail($data,'Template_email_student'));
		else
			Mail::to($user->email)->send(new SendEmail($data,'Template_email'));

		return $cible;


	}
}

?>