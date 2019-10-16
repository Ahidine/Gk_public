<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployePostRequest extends FormRequest
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
            return [
            'nom' => [
                'required', 'min:3','alpha'            
            ],
            'prenom' => [
                'required', 'min:3','alpha'
            ],
            'date_naissance' => [
                 'required','date'
            ],
            'date_affectation' => [
                 'required','date'
            ],
            'sex' => [
                'required'
            ],
            'Type' => [
                'required'
            ],
            'mobile' => [
                'required','min:10','numeric'
            ],
            'fixe' => [
                'min:10','numeric'
            ],
            'salaire' => [
                'min:10','numeric'
            ],
            'email' => [
                'unique:users,email'
                
            ],
            'contrat' => [
                'required','file','max:2048'
                
            ],
            'diplomes' => [
                'required','file','max:2048'
                
            ],
            'cv' => [
                'required','file','max:5120'
                
            ]
    
        ];
    }
}
