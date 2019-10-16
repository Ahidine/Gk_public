<?php
namespace App\Gestion;
use Illuminate\Http\Request;
Interface GroupeInterface 
{
	public function AddGroupe(Request $request);
	public function AddModulesTrimestres(Request $request,$groupe);
	public function UpdateGroupe(Request $request,$id);
	public function UpdateModulesTrimestres(Request $request,$groupe);
	public function delete($grouep);
}