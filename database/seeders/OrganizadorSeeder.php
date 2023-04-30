<?php

namespace Database\Seeders;

use App\Models\Organizador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrganizadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        Organizador::create([
           'user_id' => 2,
        ]);

        Organizador::create([
            'user_id' => 3,
        ]);
    }
}