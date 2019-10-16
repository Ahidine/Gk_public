<?php
namespace App\Gestion;
use Illuminate\Http\Request;

interface NiveauInterface
{
	public function AddNiveau(Request $request);
	public function AddModules(Request $request,$niveau);
	public function AddPrix(Request $request,$niveau);
	public function UpdateNiveau(Request $request,$id);
	public function UpdateModule(Request $request,$niveau,$id);
	public function UpdatePrix(Request $request,$niveau);
	public function delete($id);

}