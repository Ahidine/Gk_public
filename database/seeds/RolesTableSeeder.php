<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        'Responsable',
        'Professeur',
        'Eleve',
        'Responsable_Commerciale',
        'Responsable_Pedagogique',
        'Super_Admin'
        ];


        foreach ($roles as $role) {
             Role::create(['name' => $role]);
        }
    }
}
