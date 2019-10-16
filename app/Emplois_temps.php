<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emplois_temps extends Model
{
    //
    protected $table = 'emplois_temps';
   protected $fillable = ['heure_debut', 'heure_fin', 'date','prof_id','groupe_id','salle_id','trimestre_id','centre_id','module_id'];

    //has Many
//##########################

    //belongTo
    public function prof()
    {
        return $this->belongsTo('App\Professeur');
    }
    public function salle()
    {
        return $this->belongsTo('App\Salle');
    }
    public function calendrie()
    {
        return $this->belongsTo('App\Calendrie');
    }
    public function jour()
    {
        return $this->belongsTo('App\Jours');
    }
    public function groupe()
    {
        return $this->belongsTo('App\Groupe');
    }
    public function trimestre()
    {
        return $this->belongsTo('App\Trimestre');
    }
    public function centre()
    {
        return $this->belongsTo('App\Centre');
    }
    public function module()
    {
        return $this->belongsTo('App\Module');
    }
   /*     public function scopeWithJours($query)
    {
        $query->leftjoin('jours','jours.id', '=', 'emplois_temps.jour_id')
        ->Select('*');
    }*/
    //hasOne
//##########################
}
