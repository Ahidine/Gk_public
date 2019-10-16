<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'id' => 1,
            'name' => 'Super_Admin',
            'email' => 'admin@gmail.com',
            'role_id' => 6,
        ]);
        $name=Role::find(6)->name;
        User::find(1)->assignRole($name);

        factory(App\User::class)->create([
            'id' => 2,
            'name' => 'Responsable',
            'email' => 'respo@gmail.com',
            'role_id' => 1,
        ]);
        $name=Role::find(1)->name;
        User::find(2)->assignRole($name);

        factory(App\User::class)->create([
            'id' => 3,
            'name' => 'Professeur',
            'email' => 'prof@gmail.com',
            'role_id' => 2,
        ]);

        $name=Role::find(2)->name;
        User::find(3)->assignRole($name);

        factory(App\User::class)->create([
            'id' => 4,
            'name' => 'Responsable_Commerciale',
            'email' => 'respo_commercial@gmail.com',
            'role_id' => 4,
        ]);

        $name=Role::find(4)->name;
        User::find(4)->assignRole($name);

        factory(App\User::class)->create([
            'id' => 5,
            'name' => 'Eleve',
            'email' => 'eleve@gmail.com',
            'role_id' => 3,
        ]);

        $name=Role::find(3)->name;
        User::find(5)->assignRole($name);

        factory(App\User::class)->create([
            'id' => 6,
            'name' => 'Responsable_Pedagogique',
            'email' => 'respo_pedag@gmail.com',
            'role_id' => 6,
        ]);
        $name=Role::find(6)->name;
        User::find(6)->assignRole($name);

    }
}
