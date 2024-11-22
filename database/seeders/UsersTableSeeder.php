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
        $super = User::create([
            'identificacion' => '0000000009',
            'name' => 'Su',
            'telefono' => '3100000000',
            'email' => 'supersu@gmail.com',
            'password' => Hash::make('supersuf4'),
            'estado' => 'Activo'
        ]);

        $super->assignRole('ROOT');

        $admin = User::create([
            'identificacion' => '0000000001',
            'name' => 'Servi Plus & Mini Market',
            'telefono' => '3100000000',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('admin'),
            'estado' => 'Activo'
        ]);

        $admin->assignRole('ADMINISTRADOR');

        $admin = User::create([
            'identificacion' => '0000000002',
            'name' => 'Servi Plus',
            'telefono' => '3100000000',
            'email' => 'Admin2@gmail.com',
            'password' => Hash::make('admin'),
            'estado' => 'Activo'
        ]);

        $admin->assignRole('ADMINISTRADOR');

        $asesor = User::create([
            'identificacion' => '0000000002',
            'name' => 'Domiciliario 1',
            'telefono' => '3100000000',
            'email' => 'domiciliario1@gmail.com',
            'password' => Hash::make('domic'),
            'estado' => 'Activo'
        ]);

        $asesor->assignRole('DOMICILIARIO');

        $asesor = User::create([
            'identificacion' => '0000000003',
            'name' => 'Domiciliario 2',
            'telefono' => '3100000000',
            'email' => 'domiciliario2@gmail.com',
            'password' => Hash::make('domic'),
            'estado' => 'Activo'
        ]);

        $asesor->assignRole('DOMICILIARIO');

        $asesor = User::create([
            'identificacion' => '0000000004',
            'name' => 'Domiciliario 3',
            'telefono' => '3100000000',
            'email' => 'domiciliario3@gmail.com',
            'password' => Hash::make('domic'),
            'estado' => 'Activo'
        ]);

        $asesor->assignRole('DOMICILIARIO');

        $asesor = User::create([
            'identificacion' => '0000000005',
            'name' => 'Domiciliario 4',
            'telefono' => '3100000000',
            'email' => 'domiciliario4@gmail.com',
            'password' => Hash::make('domic'),
            'estado' => 'Activo'
        ]);

        $asesor->assignRole('DOMICILIARIO');
    }
}
