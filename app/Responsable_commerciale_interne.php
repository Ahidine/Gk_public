<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable_commerciale_interne extends Model
{
    //
   protected $table = 'responsable_commerciale_interne';

    //has Many
   public function eleve()
    {
        return $this->hasMany('App\Eleve');
    }
   public function user()
    {
        return $this->belongsTo('App\User');
    }
   public function salaire_commerciale()
    {
        return $this->hasMany('App\Salaire_commerciale');
    }

    //belongTo

   public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
       public function centre()
    {
        return $this->belongsTo('App\Centre');
    }

    //belongToMany
//##########################
}
