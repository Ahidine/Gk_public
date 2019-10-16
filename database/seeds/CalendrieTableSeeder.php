<?php

use Illuminate\Database\Seeder;
use App\Calendrie;


class CalendrieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [

        	['libelle'=>'Rom Event', 'date_debut'=>'2017-05-10', 'date_fin'=>'2017-05-15'],

        	['libelle'=>'Coyala Event', 'date_debut'=>'2017-05-11', 'date_fin'=>'2017-05-16'],

        	['libelle'=>'Lara Event', 'date_debut'=>'2017-05-16', 'date_fin'=>'2017-05-22'],

        ];

        foreach ($data as $key => $value) {

        	Calendrie::create($value);

        }
    }
}
