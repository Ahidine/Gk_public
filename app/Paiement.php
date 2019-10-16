<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
     //
   protected $table = 'paiement';
   protected $fillable = [
        'montant','date_reg','mode_paiement'
    ];

    //has Many
//##########################

    //belongTo
//##########################
   public function niveau()
    {
        return $this->belongsTo('App\Niveau');
    }
       public function eleve()
    {
        return $this->belongsTo('App\Eleve');
    }
    //hasOne
//##########################   

}
