<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    //
   protected $table = 'parents';
   protected $fillable = [
        'nom','prenom','type_parite','tel_mobile','tel_fixe','adresse1','adresse2','email'
    ];

    //has Many
//##########################

    //belongTo

   public function eleve()
    {
        return $this->belongToMany('App\Eleve','eleve_parents','parents_id','eleve_id');
    }

    //hasOne
//##########################
}
