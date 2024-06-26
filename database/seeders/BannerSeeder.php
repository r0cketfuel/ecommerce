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
            "imagen"        => "1.webp",
            "descripcion"   => "Banner 1",
            "link"          => "ofertazos_hogar",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);

        Banner::create([
            "imagen"        => "2.webp",
            "descripcion"   => "Banner 2",
            "link"          => "ofertas_gamers",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);

        Banner::create([
            "imagen"        => "3.webp",
            "descripcion"   => "Banner 3",
            "link"          => "ofertas_bienestar",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);

        Banner::create([
            "imagen"        => "4.webp",
            "descripcion"   => "Banner 4",
            "link"          => "especial_zapatillas",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);

        Banner::create([
            "imagen"        => "5.webp",
            "descripcion"   => "Banner 5",
            "link"          => "super_descuentos",
            "valido_desde"  => $desde,
            "valido_hasta"  => $hasta
        ]);
    }
}
