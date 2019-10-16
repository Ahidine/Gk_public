<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
	protected $table = 'ville';
    protected $fillable = [
        'nom'
    ];

    //has Many
       public function centre()
    {
        return $this->hasMany('App\Centre');
    }
    //belongTo
       public function pays()
    {
        return $this->belongsTo('App\Pays');
    }
}
