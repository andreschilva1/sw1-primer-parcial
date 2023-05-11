<?php

namespace Database\Seeders;

use App\Models\Fotografo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FotografoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            Fotografo::create([
                'user_id' => 4,
             ]);
     
             Fotografo::create([
                 'user_id' => 5,
             ]);
             Fotografo::create([
                'user_id' => 6,
            ]);

    } 
}
