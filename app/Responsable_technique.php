<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable_technique extends Model
{
    //
   protected $table = 'responsable_technique';
    //has Many
//##########################

    //belongTo

   public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
   public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    //belongToMany
//##########################
}
