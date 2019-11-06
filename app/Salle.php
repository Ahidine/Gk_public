<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    //
    //
   protected $table = 'salle';
   protected $fillable = [
        'num','capacite'
    ];

    //has Many
   public function emplois_temps()
    {
        return $this->hasMany('App\Emplois_temps');
    }

    //belongTo
//##########################
    public function  centre()
    {
        return $this->belongsTo('App\Centre');
    }

    //belongToMany
//##########################
}
