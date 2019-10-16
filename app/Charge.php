<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    //
      protected $table = 'charges';
      protected $fillable = [
            'nom_charge', 'montant',
        ];

    //has Many
#########################


     //belongTo
    public function centre()
    {
        return $this->belongsTo('App\Centre');
    }
}
