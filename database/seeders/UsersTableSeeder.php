<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Fabio Cordoba',
            'email' => 'fabiocordoba1@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $admin->assignRole('ADMINISTRADOR');

        $asesor = User::create([
            'name' => 'Domiciliario 1',
            'email' => 'domiciliario1@gmail.com',
            'password' => Hash::make('domic'),
        ]);

        $asesor->assignRole('DOMICILIARIO');
    }
}
