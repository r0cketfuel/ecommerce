<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            Rating::create([
                "articulo_id"       => $i,
                "visualizaciones"   => 0,
                "puntuaciones"      => 0,
                "sumatoria"         => 0,
                "promedio"          => 0
            ]);
        }
    }
}
