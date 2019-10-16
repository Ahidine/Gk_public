<?php

use Illuminate\Database\Seeder;

class ResponsableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('responsable')->insert([
            'id' => 1,
            'nom' => 'responsable',
            'prenom' => 'respo',
            'date_naissance'=>'1985-08-07',
            'user_id'=> 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
