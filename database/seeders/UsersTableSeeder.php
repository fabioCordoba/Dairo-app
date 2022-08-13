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
            'identificacion' => '0000000001',
            'name' => 'ADMIN 001',
            'telefono' => '3100000000',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        $admin->assignRole('ADMINISTRADOR');

        $asesor = User::create([
            'identificacion' => '0000000002',
            'name' => 'Domiciliario 1',
            'telefono' => '3100000000',
            'email' => 'domiciliario1@gmail.com',
            'password' => Hash::make('domic'),
        ]);

        $asesor->assignRole('DOMICILIARIO');
    }
}
