<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //fotos temporales
        Storage::deleteDirectory('public/livewire-tmp');
        Storage::makeDirectory('public/livewire-tmp');
        
        //directorio para las imagenes de los usuarios
        Storage::deleteDirectory('public/usuarios');
        Storage::makeDirectory('public/usuarios');

        //directorio para las imagenes de perfil de los eventos
        Storage::deleteDirectory('public/eventos');
        Storage::makeDirectory('public/eventos');

        //directorio para las imagenes de los de los invitados q asistieron al evento 
        Storage::deleteDirectory('public/imagenes');
        Storage::makeDirectory('public/imagenes'); 
        /* \App\Models\User::factory(10)->create()->assignRole('Admin'); */

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeeder::class);
        $this->call(OrganizadorSeeder::class);
        \App\Models\Evento::factory(20)->create();
        $this->call(ClienteSeeder::class);
        $this->call(FotografoSeeder::class);
        
    }
}
