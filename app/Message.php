<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    //
   protected $table = 'message';
   protected $fillable = [
        'libelle', 'date_message','type'
    ];

    //has Many
   public function contenu()
    {
        return $this->hasMany('App\Contenu');
    }

    //belongTo
//##########################
   public function users()
    {
        return $this->belongTo('App\User');
    }

    //belongToMany
//##########################
}
