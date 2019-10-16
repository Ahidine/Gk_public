<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salaire_commerciale extends Model
{
      protected $table = 'salaire_commerciale';
      protected $fillable = [
        'commission','nombre_eleves','date_echeance','date_traitement'
    ];

    //has Many
//##########################

    //belongToMany
    public function comerciale_interne()
    {
        return $this->belongsTo('App\Responsable_commerciale_interne');
    }
    //hasOne
//##########################
}
