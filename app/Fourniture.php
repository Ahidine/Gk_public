<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fourniture extends Model
{
     //
   protected $table = 'fourniture';
   protected $fillable = [
        'Est_Livre', 'commentaire', 'date_livraison'
    ];

    //has Many
//##########################

    //belongTo
//##########################
   public function eleve()
    {
        return $this->belongTo('App\Eleve');
    }
   public function module()
    {
        return $this->belongTo('App\Module');
    }
    //hasOne
//##########################  
}
