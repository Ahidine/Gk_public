<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    //
   protected $table = 'contenu';
    protected $fillable = [
        'contenu', 'date_contenu',
    ];

    //has Many

    //belongTo
//##########################
   public function message()
    {
        return $this->belongTo('App\Message');
    }
   public function users()
    {
        return $this->belongTo('App\User');
    }


    //hasOne
//##########################
}
