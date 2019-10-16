<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
     protected $table = 'centre';

     protected $fillable = ['nom', 'adresse'];


    //has Many
   public function produits_annexe()
    {
        return $this->hasMany('App\Produits_Annexe');
    }
   public function charge()
    {
        return $this->hasMany('App\Charge');
    }
   public function activite()
    {
        return $this->hasMany('App\Activite');
    }

   public function eleve()
    {
        return $this->hasMany('App\Eleve');
    }
   public function commerciale_externe()
    {
        return $this->hasMany('App\Responsable_commerciale_externe');
    }
    public function frais_inscriptions()
    {
        return $this->hasMany('App\Frais_inscription');
    }
    public function emplois_temps()
    {
        return $this->hasMany('App\Emplois_temps');
    }


    // belongto
    public function responsable()
    {
        return $this->belongsTo('App\Responsable');
    }

    public function ville()
    {
        return $this->belongsTo('App\Ville');
    }
    //belongToMany
         public function eleve_transfert()
    {
        return $this->belongsToMany('App\Eleve','transfert','centre_id','eleve_id');
    }

        public function niveau()
    {
        return $this->belongsToMany('App\Niveau','centre_niveau','centre_id','niveau_id')->withPivot('prix', 'devise');
    }
        public function employe()
    {
        return $this->belongsToMany('App\Employe','employe_centre','centre_id','employe_id');
    }


}
