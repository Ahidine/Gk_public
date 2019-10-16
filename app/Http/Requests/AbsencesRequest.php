<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsencesRequest extends FormRequest
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
            'motif' => [
                 'min:3','alpha'            
            ],
            'heure_debut' => [
                'required', 'min:3','alpha'
            ],
            'heure_fin' => [
                'required'
            ],
            'date' => [
                'date','required'
            ],
            'type' => [
                'required','min:10'
            ]
    
        ];
    }
}
