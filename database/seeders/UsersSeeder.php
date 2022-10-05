<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cedula' => 1048680728,
            'nombre' => 'Cesar',
            'apellido' => 'Bermudez',
            'perfil' => 'Admin',
            'telefono' => 3014512332,
            'email' => 'cesarb@gamail.com',
            'password' => bcrypt(123456)
        ]);
    }
}
