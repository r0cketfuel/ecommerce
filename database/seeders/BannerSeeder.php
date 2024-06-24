<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Banner;
use DateTime;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desde = date("Y-m-d H:i:s");
        $hasta = $desde;

        $date = new DateTime("+1 year");
        $hasta = $date->format("Y-m-d H:i:s");
        
        Banner::create([
            "imagen"        => "1.png",
            "descripcion"   => "Banner 1",
            "link"          => "semana_electrohogar",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);

        Banner::create([
            "imagen"        => "2.png",
            "descripcion"   => "Banner 2",
            "link"          => "electro",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);

        Banner::create([
            "imagen"        => "3.png",
            "descripcion"   => "Banner 3",
            "link"          => "amigos_beneficios",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);

        Banner::create([
            "imagen"        => "4.png",
            "descripcion"   => "Banner 4",
            "link"          => "megaofertas",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);

        Banner::create([
            "imagen"        => "5.png",
            "descripcion"   => "Banner 5",
            "link"          => "especial_juguetes",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);
    }
}
