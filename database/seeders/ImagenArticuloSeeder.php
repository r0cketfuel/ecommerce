<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImagenArticulo;

class ImagenArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImagenArticulo::create([
            "articulo_id"   => 1,
            "ruta"          => "1.png",
            "descripcion"   => "Imágen 1 del artículo 1"
        ]);

        ImagenArticulo::create([
            "articulo_id"   => 1,
            "ruta"          => "2.png",
            "descripcion"   => "Imágen 2 del artículo 1"
        ]);

        ImagenArticulo::create([
            "articulo_id"   => 1,
            "ruta"          => "3.png",
            "descripcion"   => "Imágen 3 del artículo 1"
        ]);

        ImagenArticulo::create([
            "articulo_id"   => 1,
            "ruta"          => "4.png",
            "descripcion"   => "Imágen 4 del artículo 1"
        ]);

        ImagenArticulo::create([
            "articulo_id"   => 1,
            "ruta"          => "5.png",
            "descripcion"   => "Imágen 5 del artículo 1"
        ]);

        ImagenArticulo::create([
            "articulo_id"   => 2,
            "ruta"          => "1.png",
            "descripcion"   => "Imágen 1 del artículo 2"
        ]);

        ImagenArticulo::create([
            "articulo_id"   => 2,
            "ruta"          => "2.png",
            "descripcion"   => "Imágen 2 del artículo 2"
        ]);
    }
}
