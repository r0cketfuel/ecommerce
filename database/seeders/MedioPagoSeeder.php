<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\MedioPago;

class MedioPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedioPago::create([
            "medio"         => "Efectivo"
        ]);

        MedioPago::create([
            "medio"         => "Transferencia bancaria"
        ]);

        MedioPago::create([
            "medio"         => "Tarjeta de crédito o débito"
        ]);

        MedioPago::create([
            "medio"         => "PagoFácil"
        ]);

        MedioPago::create([
            "medio"         => "RapiPago"
        ]);
    }
}
