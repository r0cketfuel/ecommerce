<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UsuarioDomicilio;

class UsuarioDomicilioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsuarioDomicilio::create([
            "usuario_id"                => 1,
            "domicilio"                 => "Domicilio",
            "domicilio_nro"             => "1234",
            "domicilio_piso"            => "PB",
            "domicilio_depto"           => "2",
            "domicilio_aclaraciones"    => "Timbre del medio",
            "localidad"                 => "Bahía Blanca",
            "codigo_postal"             => "8000",
            "principal"                 => true,
        ]);
    }
}
