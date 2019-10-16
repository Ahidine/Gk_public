<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frais_inscription extends Model
{
    //
   protected $table = 'frais_inscriptions';
   protected $fillable = [
        'montant', 'devise'
    ];

    //has Many
   public function paiement()
    {
        return $this->hasMany('App\Paiement');
    }

    //belongTo
//##########################
   public function niveau()
    {
        return $this->belongTo('App\Niveau');
    }

    //hasOne
//##########################
}
