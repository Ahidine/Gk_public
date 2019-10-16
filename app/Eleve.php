<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    //
    //
   protected $table = 'eleve';
   protected $fillable = [
        'nom', 'prenom', 'date_naissance','lieu_naissance','path_photo','sex','nationalite','adresse','Est_Inscrit',
    ];

    //has Many
   public function paiement()
    {
        return $this->hasMany('App\Paiement');
    }
   public function absences()
    {
        return $this->hasMany('App\Absence');
    }
   public function examen()
    {
        return $this->hasMany('App\Examen');
    }
   public function fourniture()
    {
        return $this->hasMany('App\Fourniture');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //belongTo
//##########################
    public function centre()
    {
        return $this->belongsTo('App\Centre');
    }
    public function responsable_commerciale_interne()
    {
        return $this->belongsTo('App\Responsable_commerciale_interne');
    }
    public function responsable_commerciale_externe()
    {
        return $this->belongsTo('App\Responsable_commerciale_externe');
    }

     public function groupe()
    {
        return $this->belongsTo('App\Groupe');
    }
    //belongToMany
     public function parents()
    {
        return $this->belongsToMany('App\Parents','eleve_parents','eleve_id','parents_id');
    }
     public function centre_transfert()
    {
        return $this->belongsToMany('App\Centre','transfert','eleve_id','centre_id');
    }

    //hasOne
//##########################
}
