<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genero;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genero::create([
            "genero" => "Femenino",
        ]);

        Genero::create([
            "genero" => "Masculino",
        ]);
        
        Genero::create([
            "genero" => "No binario",
        ]);
    }
}
