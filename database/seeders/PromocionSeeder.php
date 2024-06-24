<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promocion;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Promocion::create([
            "articulo_id"   => 1,
            "valido_desde"  => now(),
            "valido_hasta"  => '2024-12-01',
            "descuento"     => 10
        ]);
    }
}
