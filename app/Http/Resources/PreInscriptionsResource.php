<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PreInscriptionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nom'=>$this->nom,
            'prenom'=>$this->prenom,
            'numero'=>$this->numero,
            'comment'=>$this->comment,
            'age'=>$this->age,
            'centre_id'=>$this->centre_id,
        ];
    }
}
