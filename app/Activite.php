<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    //
   protected $table = 'activites';
   protected $fillable = [
        'nom_Activite', 'description', 'date_activite','responsable_activite',
    ];
    //has Many
#########################

     //belongToMany
    public function centre()
    {
        return $this->belongsTo('App\Centre');
    }

    public function calendrie()
    {
        return $this->belongsTo('App\Calendrie');
    }
}
