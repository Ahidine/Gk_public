<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    //
        //
   protected $table = 'diplome';
   protected $fillable = [
        'intitule', 'ecole', 'specialite','date_obtention'
    ];

    //has Many
//##########################

    //belongToMany
    public function professeur()
    {
        return $this->belongsTo('App\Professeur');
    }

    //hasOne
//##########################
}
