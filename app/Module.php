<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
   protected $table = 'module';
   protected $fillable = [
        'nom_module'
    ];

    //has Many
   public function fourniture()
    {
        return $this->hasMany('App\Fourniture');
    }
 /*  public function etudes()
    {
        return $this->hasMany('App\Etude');
    }*/
    public function examen()
    {
        return $this->hasMany('App\Examen');
    }
    public function emplois_temps()
    {
        return $this->hasMany('App\Emplois_temps');
    }
    public function groupe()
    {
        return $this->belongsToMany('App\Groupe','etude','module_id', 'groupe_id');
    }


    //belongTo
//##########################
   public function niveau()
    {
        return $this->belongsTo('App\Niveau');
    }

   public function trimestre()
    {
        return $this->belongsToMany('App\Trimestre','etude','module_id', 'trimestre_id');  
    }


    //hasOne
//##########################
}
