<?php

use Illuminate\Database\Seeder;

class SalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
                //
     DB::table('salle')->insert([
            'id' => 1,
            'num' => 'A1',
            'capacite'=> 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);  
     DB::table('salle')->insert([
            'id' => 2,
            'num' => 'B1',
            'capacite'=> 15,
            'created_at' => now(),
            'updated_at' => now()
        ]);  
     DB::table('salle')->insert([
            'id' => 3,
            'num' => 'C1',
            'capacite'=> 15,
            'created_at' => now(),
            'updated_at' => now()
        ]); 
     DB::table('salle')->insert([
            'id' => 4,
            'num' => 'D1',
            'capacite'=> 15,
            'created_at' => now(),
            'updated_at' => now()
        ]); 
    }
}
