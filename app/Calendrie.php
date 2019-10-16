<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendrie extends Model
{
    //
 protected $table = 'calendrie';
 protected $fillable = [
        'libelle', 'date_debut', 'date_fin','motif'
    ];

    //belongTo
//##########################

    //has Many

   public function activite()
    {
        return $this->hasMany('App\Activite');
    }
   public function emplois_temps()
    {
        return $this->hasMany('App\Emplois_temps');
    }

    //hasOne
//##########################
}
