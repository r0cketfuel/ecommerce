<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Articulo;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            Articulo::create([
                "codigo"            => sprintf("%04d", $i),
                "nombre"            => "Item $i",
                "descripcion"       => "Descripción item $i",
                "precio"            => $i * 100.00,
                "categoria_id"      => ($i % 3) + 1,
                "subcategoria_id"   => $i % 2 == 0 ? $i % 3 + 1 : NULL,
                "estado"            => 1
            ]);
        }
    }
}
