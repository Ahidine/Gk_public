<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    //
     protected $table = 'professeur';
     protected $fillable = [
        'nom','prenom','date_naissance','date_affectation','Tel_mobile','Tel_fixe','adresse','type'
    ];

    //has Many
       public function salaire_prof()
    {
        return $this->hasMany('App\Salaire_prof','Prof_id');
    }
       public function diplomes()
    {
        return $this->hasMany('App\Diplome','prof_id');
    }
       public function emplois_temps()
    {
        return $this->hasMany('App\Emplois_temps','prof_id');
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

    //relation reflexive 
    //belongToMany 
    //prof a un remplaçant
    public function remplacants()
    {
        return $this->belongsToMany('App\Professeur','remplacants_prof','prof_id','remplacant_id');
    }
    //prof a remplace un autre  prof 
    public function Aremplacer()
    {
        return $this->belongsToMany('App\Professeur','remplacants_prof','remplacant_id','prof_id');
    }   

 
}
