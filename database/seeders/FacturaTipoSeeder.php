<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FacturaTipo;

class FacturaTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacturaTipo::create([
            "tipo"          => "A",
            "descripcion"   => "De responsable inscripto a responsable inscripto o monotributista"
        ]);

        FacturaTipo::create([
            "tipo"          => "B",
            "descripcion"   => "De responsable inscripto a consumidor final o exento en el IVA"
        ]);

        FacturaTipo::create([
            "tipo"          => "C",
            "descripcion"   => "De monotributista o exento en el IVA a todo destinatario"
        ]);

        FacturaTipo::create([
            "tipo"          => "M",
            "descripcion"   => "De responsable inscripto a responsable inscripto"
        ]);

        FacturaTipo::create([
            "tipo"          => "E",
            "descripcion"   => "De exportador a sujeto del exterior"
        ]);

        FacturaTipo::create([
            "tipo"          => "T",
            "descripcion"   => "De hotel o servicio de alojamiento a turistas extranjeros"
        ]);
    }
}
