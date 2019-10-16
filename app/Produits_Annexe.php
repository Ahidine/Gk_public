<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produits_Annexe extends Model
{
    //
     protected $table = 'produits_annexe';
     protected $fillable = [
        'nom_produits','montant'
    ];

    //has Many
#########################


     //belongToMany
    public function centre()
    {
        return $this->belongsTo('App\Centre');
    }
}
