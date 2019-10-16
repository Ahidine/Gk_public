<?php

use Illuminate\Database\Seeder;

class JoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
   	DB::table('jours')->insert([
            'id' => 1,
            'jour' => 'Lundi',
            'created_at' => now(),
            'updated_at' => now()
        ]);  
     DB::table('jours')->insert([
            'id' => 2,
            'jour' => 'Mardi',
            'created_at' => now(),
            'updated_at' => now()
        ]);  
     DB::table('jours')->insert([
            'id' => 3,
            'jour' => 'Mercredi',
            'created_at' => now(),
            'updated_at' => now()
        ]); 
     DB::table('jours')->insert([
            'id' => 4,
            'jour' => 'Jeudi',
            'created_at' => now(),
            'updated_at' => now()
        ]); 
     DB::table('jours')->insert([
            'id' => 5,
            'jour' => 'Vendredi',
            'created_at' => now(),
            'updated_at' => now()
        ]); 
     DB::table('jours')->insert([
            'id' => 7,
            'jour' => 'Samedi',
            'created_at' => now(),
            'updated_at' => now()
        ]); 
     DB::table('jours')->insert([
            'id' => 8,
            'jour' => 'Dimanche',
            'created_at' => now(),
            'updated_at' => now()
        ]); 
    }
}
