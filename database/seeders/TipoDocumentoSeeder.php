<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoDocumento::create([
            "tipo"          => "DNI",
            "descripcion"   => "Documento Nacional de Identidad",
        ]);

        TipoDocumento::create([
            "tipo"          => "LC",
            "descripcion"   => "Libreta cívica",
        ]);

        TipoDocumento::create([
            "tipo"          => "LE",
            "descripcion"   => "Libreta de enrolamiento",
        ]);

        TipoDocumento::create([
            "tipo"          => "CI",
            "descripcion"   => "Cédula de identidad",
        ]);

        TipoDocumento::create([
            "tipo"          => "PA",
            "descripcion"   => "Pasaporte",
        ]);
    }
}
