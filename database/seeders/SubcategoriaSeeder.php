<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Subcategoria;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subcategoria::create([
            "categoria_id"  => 1,
            "nombre"        => "Subcategoría 1",
            "descripcion"   => "Descripción Subcategoría 1"
        ]);

        Subcategoria::create([
            "categoria_id"  => 1,
            "nombre"        => "Subcategoría 2",
            "descripcion"   => "Descripción Subcategoría 2"
        ]);

        Subcategoria::create([
            "categoria_id"  => 2,
            "nombre"        => "Subcategoría 3",
            "descripcion"   => "Descripción Subcategoría 3"
        ]);

        Subcategoria::create([
            "categoria_id"  => 2,
            "nombre"        => "Subcategoría 4",
            "descripcion"   => "Descripción Subcategoría 4"
        ]);

        Subcategoria::create([
            "categoria_id"  => 3,
            "nombre"        => "Subcategoría 5",
            "descripcion"   => "Descripción Subcategoría 5"
        ]);

        Subcategoria::create([
            "categoria_id"  => 3,
            "nombre"        => "Subcategoría 6",
            "descripcion"   => "Descripción Subcategoría 6"
        ]);

        Subcategoria::create([
            "categoria_id"  => 4,
            "nombre"        => "Subcategoría 7",
            "descripcion"   => "Descripción Subcategoría 7"
        ]);

        Subcategoria::create([
            "categoria_id"  => 5,
            "nombre"        => "Subcategoría 8",
            "descripcion"   => "Descripción Subcategoría 8"
        ]);
    }
}
