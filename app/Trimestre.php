<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    //
   //
   protected $table = 'trimestre';
   protected $fillable = ['date_debut','date_fin','nom'];

    //has Many


    //belongTo

    //belongToMany
   public function groupe()
    {
        return $this->belongsToMany('App\Groupe','etude','trimestre_id','groupe_id');
    }

   public function module()
    {
       return $this->belongsToMany('App\Module','etude','trimestre_id', 'module_id');  
    }
   public function emplois_temps()
    {
       return $this->hasMany('App\Emplois_temps');  
    }


}
