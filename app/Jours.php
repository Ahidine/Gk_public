<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jours extends Model
{
    //
   protected $table = 'jours';
   protected $fillable = [
        'jour'
    ];

    //has Many
   public function emploie_temps()
    {
        return $this->hasMany('App\Emploie_temps');
    }

    //belongTo
//##########################

    //hasOne
//##########################
}
