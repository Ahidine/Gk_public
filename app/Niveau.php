<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    //
   protected $table = 'niveau';
   protected $fillable = ['type'];


    //has Many
   public function frais_inscirptions()
    {
        return $this->hasMany('App\Frais_inscirption');
    }
   public function module()
    {
        return $this->hasMany('App\Module');
    }
       public function paiements()
    {
        return $this->hasMany('App\Paiement');
    }


    //belongToMany
//##########################
   public function centre()
    {
       return $this->belongsToMany('App\Centre','centre_niveau','niveau_id','centre_id')->withPivot('prix', 'devise');
      }

    //hasOne
//##########################
}
