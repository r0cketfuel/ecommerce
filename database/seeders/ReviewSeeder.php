<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            "usuario_id"    => 1,
            "articulo_id"   => 1,
            "fecha"         => "2022-11-28 10:58:00",
            "titulo"        => "Review de prueba",
            "texto"         => "Review de prueba sobre el artículo 1",
        ]);

        Review::create([
            "usuario_id"    => 1,
            "articulo_id"   => 1,
            "fecha"         => "2023-02-21 10:58:00",
            "titulo"        => "Review de prueba 2",
            "texto"         => "Review de prueba 2 sobre el artículo 1",
        ]);

        Review::create([
            "usuario_id"    => 1,
            "articulo_id"   => 1,
            "fecha"         => "2023-02-21 10:58:00",
            "titulo"        => "Review de prueba 3",
            "texto"         => "Review de prueba 3 sobre el artículo 1",
        ]);
    }
}
