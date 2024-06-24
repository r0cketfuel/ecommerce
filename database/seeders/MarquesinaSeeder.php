<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Marquesina;
use DateTime;

class MarquesinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desde  = now();
        $hasta  = now();

        $date   = new DateTime("+1 year");
        $hasta  = $date->format("Y-m-d H:i:s");
        
        Marquesina::create([
            "mensaje"       => "Mensaje de pruebas",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);
    }
}
