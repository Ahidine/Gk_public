<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //
   protected $table = 'absences';
   protected $fillable = [
        'heure_debut', 'heure_fin', 'date_absence','motif','type'
    ];

    //has Many
//##########################

    //belongTo

   public function eleve()
    {
        return $this->belongsTo('App\Eleve');
    }
   public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    //hasOne
//##########################
}
