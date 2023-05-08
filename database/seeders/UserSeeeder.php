<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12345678');

        User::create([
            'name' => 'Andres',
            'email' => 'wasulwasol@gmail.com',
            'password' => $password,
            'profile_photo_path' => null,
            'telefono' => '69465520',
        ])->assignRole('Admin');

        User::create([
            'name' => 'Carlos Ponce',
            'email' => 'carlos@gmail.com',
            'password' => $password,
            'profile_photo_path' => null,
            'telefono' => '65152340',
        ])->assignRole('Organizador');

        User::create([
            'name' => 'Juan Mendoza Pereira',
            'email' => 'juan@gmail.com',
            'password' => $password,
            'profile_photo_path' => null,
            'telefono' => '75174852',
        ])->assignRole('Organizador');
        User::create([
            'name' => 'Marco Antonio Soliz',
            'email' => 'marco@gmail.com',
            'password' => $password,
            'profile_photo_path' => null,
            'telefono' => '63295852',
        ])->assignRole('Cliente');
        User::create([
            'name' => 'Lucia Rodrigues',
            'email' => 'lucia_bnb@gmail.com',
            'password' => $password,
            'profile_photo_path' => null,
            'telefono' => '63295811',
        ])->assignRole('Cliente');

        User::create([
            'name' => 'Enrique Iglesias',
            'email' => 'enrique_bnb@gmail.com',
            'password' => $password,
            'profile_photo_path' => null,
            'telefono' => '64140472',
        ])->assignRole('Fotografo');
        User::create([
            'name' => 'Andres Luis Guerra',
            'email' => 'andres_bnb@gmail.com',
            'password' => $password,
            'profile_photo_path' => null,
            'telefono' => '64140472',
        ])->assignRole('Fotografo');
        User::create([
            'name' => 'Alberto Soliz Montenegro',
            'email' => 'alberto_bnb@gmail.com',
            'password' => $password,
            'profile_photo_path' => null,
            'telefono' => '74191823',
        ])->assignRole('Admin');
        User::create([
            'name' => 'Patrick Smith',
            'email' => 'patrick_bnb@gmail.com',
            'password' => $password,
            'profile_photo_path' => null,
            'telefono' => '69181875',
        ])->assignRole('Admin');
 
    } 
}
