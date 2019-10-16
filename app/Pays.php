<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    //
    protected $table = 'pays';
    protected $fillable = [
        'nom'
    ];

    //has Many 
       public function villes()
    {
        return $this->hasMany('App\Ville');
    }
    //belongToMany

}
