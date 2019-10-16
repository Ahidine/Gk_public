<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etude extends Model
{
    // 
     protected $table = 'etude';

    //has Many
   public function groupe()
    {
        return $this->belongsTo('App\Groupe');
    }

   public function module()
    {
        return $this->belongsTo('App\Module');
    }

   public function trimestre()
    {
        return $this->belongsTo('App\Trimestre');
    }
}
