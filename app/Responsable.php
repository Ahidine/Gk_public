<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    //
        protected $table = 'responsable';
        protected $fillable = ['nom'];

    //has Many
       public function centre()
    {
        return $this->hasMany('App\Centre');
    }

    //belongTo
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
  
}
