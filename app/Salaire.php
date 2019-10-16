<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
      protected $table = 'salaire';
      protected $fillable = [
        'salaire','date_echeance','date_traitement'
    ];

    //has Many
//##########################

    //belongToMany
    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
    //hasOne
//##########################

}
