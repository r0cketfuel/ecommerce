<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\AtributoArticulo;

class AtributoArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AtributoArticulo::create([
            "articulo_id"   => 1,
            "talle_id"      => NULL,
            "color"         => NULL,
            "compra_min"    => 1,
            "compra_max"    => 5,
            "stock"         => 100,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 2,
            "talle_id"      => 1,
            "color"         => NULL,
            "compra_min"    => NULL,
            "compra_max"    => NULL,
            "stock"         => 50,
            "imagen_id"     => 6
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 2,
            "talle_id"      => 3,
            "color"         => NULL,
            "compra_min"    => NULL,
            "compra_max"    => NULL,
            "stock"         => 33,
            "imagen_id"     => 7
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 3,
            "talle_id"      => NULL,
            "color"         => "#32a852",
            "compra_min"    => NULL,
            "compra_max"    => NULL,
            "stock"         => 101,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 3,
            "talle_id"      => NULL,
            "color"         => "#42a952",
            "compra_min"    => NULL,
            "compra_max"    => NULL,
            "stock"         => 66,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 4,
            "talle_id"      => 2,
            "color"         => "#22a850",
            "compra_min"    => NULL,
            "compra_max"    => NULL,
            "stock"         => 30,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 4,
            "talle_id"      => 2,
            "color"         => "#42f842",
            "compra_min"    => NULL,
            "compra_max"    => NULL,
            "stock"         => 44,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 4,
            "talle_id"      => 3,
            "color"         => "#32a052",
            "compra_min"    => NULL,
            "compra_max"    => NULL,
            "stock"         => 51,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 4,
            "talle_id"      => 3,
            "color"         => "#32a700",
            "compra_min"    => NULL,
            "compra_max"    => NULL,
            "stock"         => 23,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 4,
            "talle_id"      => 4,
            "color"         => "#32a500",
            "compra_min"    => NULL,
            "compra_max"    => NULL,
            "stock"         => 88,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 5,
            "talle_id"      => NULL,
            "color"         => NULL,
            "compra_min"    => 1,
            "compra_max"    => 2,
            "stock"         => 15,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 6,
            "talle_id"      => 1,
            "color"         => "#32a500",
            "compra_min"    => 1,
            "compra_max"    => 2,
            "stock"         => 14,
            "imagen_id"     => NULL
        ]);
        
        AtributoArticulo::create([
            "articulo_id"   => 6,
            "talle_id"      => 2,
            "color"         => "#32a570",
            "compra_min"    => 1,
            "compra_max"    => 3,
            "stock"         => 11,
            "imagen_id"     => NULL
        ]);
    }
}
