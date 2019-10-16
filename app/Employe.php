<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    //
    protected $table = 'employe';
    protected $fillable = [
        'nom', 'prenom','date_affectation','Tel','adresse','fonction','Type','user_id'
    ];

    //has Many
       public function salaires()
    {
        return $this->hasMany('App\Salaire');
    }
       public function absences()
    {
        return $this->hasMany('App\Absence');
    }
    //belongsToMany
    public function centre()
    {
        return $this->belongsToMany('App\Centre','employe_centre','employe_id','centre_id');
    }  
    //hasOne
    public function prof()
    {
        return $this->hasOne('App\Professeur');
    }
    public function commericale_interne()
    {
        return $this->hasOne('App\Responsable_commerciale_interne');
    }
    public function responsable_technique()
    {
        return $this->hasOne('App\Responsable_technique');
    }
    public function responsable()
    {
        return $this->hasOne('App\Responsable');
    }

}
