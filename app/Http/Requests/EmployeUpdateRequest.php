<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Employe;
use App\Professeur;

class EmployeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
     
        if($this->Employe)
        $id=$this->Employe;
        else
         $id=Professeur::find($this->Prof)->employe_id;  

    // dd($id);


        
            return [
            'nom' => [
                'required', 'min:3','alpha'            
            ],
            'prenom' => [
                'required', 'min:3','alpha'
            ],
            'centre' => [
                'required'
            ],
            'date_naissance' => [
                 'required','date_format:Y-m-d'
            ],
            'date_affectation' => [
                 'required','date_format:Y-m-d'
            ],
            'sex' => [
                'required'
            ],
            'Type' => [
                'required'
            ],
            'mobile' => [
                'min:10','numeric'
            ],
            'fixe' => [
                'min:10','numeric'
            ],
            'salaire' => [
                'min:10','numeric'
            ],
            'fonction' => [
                'required'
                
            ],
            'email' => [
                'unique:employe,email,' . $id . ',id',
                
            ],
            'contrat' => [
                'file','max:2048'
                
            ],
            'diplomes' => [
                'file','max:2048'
                
            ],
            'cv' => [
                'file','max:5120'
                
            ]
    
        ];
    }
}
