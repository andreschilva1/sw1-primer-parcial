<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'user_id' => 1,
         ]);
 
         Cliente::create([
             'user_id' => 2,
         ]);
        
         Cliente::create([
            'user_id' => 3,
        ]);
   
    } 
}
