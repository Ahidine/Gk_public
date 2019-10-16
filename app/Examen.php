<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    //
   protected $table = 'examen';
   protected $fillable = [
        'libelle', 'date_examen', 'periode','note'
    ];
    //has Many


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
