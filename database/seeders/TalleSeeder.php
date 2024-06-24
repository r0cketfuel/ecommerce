<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Talle;

class TalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Talle::create([
            "talle" => "XS",
        ]);
        
        Talle::create([
            "talle" => "S",
        ]);

        Talle::create([
            "talle" => "M",
        ]);

        Talle::create([
            "talle" => "XL",
        ]);

        Talle::create([
            "talle" => "XXL",
        ]);
    }
}
