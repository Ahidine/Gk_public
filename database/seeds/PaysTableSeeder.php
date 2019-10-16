<?php

use Illuminate\Database\Seeder;

class PaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      DB::table('pays')->insert([
            'id' => 1,
            'nom' => 'Maroc',
            'created_at' => now(),
            'updated_at' => now()
        ]);  
      DB::table('pays')->insert([
            'id' => 2,
            'nom' => 'Belgique',
            'created_at' => now(),
            'updated_at' => now()
        ]);  
    }
}
