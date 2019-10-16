<?php


namespace App; 


use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    //
   protected $table = 'groupe';

   protected $fillable = ['nom_groupe','capacite'];

    //has Many
   public function emplois_temps()
    {
        return $this->hasMany('App\Emplois_temps');
    }
 /*  public function etudes()
    {
        return $this->hasMany('App\Etude');
    }*/

   public function eleves()
    {
        return $this->hasMany('App\Eleve');
    }
    //belongsTo
   //##########################
   public function niveau()
    {
        return $this->belongsTo('App\Niveau');
    }
   public function centre()
    {
        return $this->belongsTo('App\Centre');
    }
    //belongToMany
   public function trimestre()
    {
        return $this->belongsToMany('App\Trimestre','etude','groupe_id','trimestre_id');
    }
     public function module()
    {
        return $this->belongsToMany('App\Module','etude','groupe_id','module_id');
    }

}
