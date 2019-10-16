<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salaire_prof extends Model
{
    //
       protected $table = 'salaire_prof';
       protected $fillable = [
        'prixParSeance','NombreSeance','date_echeance','date_traitement'
    ];


    //has Many
//##########################

    //belongTo
    public function professeur()
    {
        return $this->belongsTo('App\Professeur');
    }

    //hasOne
//##########################
}
