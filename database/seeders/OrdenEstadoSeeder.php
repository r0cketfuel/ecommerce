<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrdenEstado;

class OrdenEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrdenEstado::create([
            "estado" => "Iniciada"
        ]);
        
        OrdenEstado::create([
            "estado" => "En proceso"
        ]);

        OrdenEstado::create([
            "estado" => "Finalizada"
        ]);

        OrdenEstado::create([
            "estado" => "Cancelada"
        ]);
    }
}
