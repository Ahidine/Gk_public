<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salaire_commerciale_externe extends Model
{
    //
      protected $table = 'salaire_commerciale_externe';
      protected $fillable = [
        'commission','nombre_eleves','date_echeance','date_traitement'
    ];

    //has Many
//##########################

    //belongToMany
    public function comerciale_externe()
    {
        return $this->belongsTo('App\Responsable_commerciale_externe');
    }
    //hasOne
//##########################
}
