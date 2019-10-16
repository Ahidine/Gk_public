<?php
namespace App\Gestion;
use Illuminate\Http\Request;

interface EleveInterface
{
	public function AddPreinscrit(Request $request);
	public function AddInscrit(Request $request);
	public function AddParent(Request $request,$eleve);
	public function AddPaiement(Request $request);
	public function GetListeInscrit();
	public function getInfo($id);
	public function getPaiementByYear($id,$year);
	public function getAbsencesByYearByMonth($year,$month,$id);
	public function AddAbsenceForStudent(Request $request);

}