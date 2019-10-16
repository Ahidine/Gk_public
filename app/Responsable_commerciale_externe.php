<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable_commerciale_externe extends Model
{
    //
   protected $table = 'responsable_commerciale_externe';
   protected $fillable = [
        'nom','prenom','date_affectation','Tel','adresse'
    ];

    //has Many
   public function eleve()
    {
        return $this->hasMany('App\Eleve');
    }
   public function salaire_commerciale_externe()
    {
        return $this->hasMany('App\Salaire_commerciale_externe');
    }

    //belongTo
//##########################
    
    //belongToMany
//##########################
}
