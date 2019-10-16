<?php
namespace App\Gestion;
use Illuminate\Http\Request;
use App\Http\Requests\EmployePostRequest;
use App\Http\Requests\EmployeUpdateRequest;

interface EmployerInterface
{
	public function AddEmployer(EmployePostRequest $request,$fonction);
	public function UpdateEmployer(EmployeUpdateRequest $request,$fonction,$employe);
	public function DeleteEmployer($employe);
	public function AddAbsences(Request $request);
}


?>