<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FacturaEstado;

class FacturaEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacturaEstado::create([
            "estado" => "Paga"
        ]);
        
        FacturaEstado::create([
            "estado" => "Impaga"
        ]);

        FacturaEstado::create([
            "estado" => "Anulada"
        ]);
    }
}
