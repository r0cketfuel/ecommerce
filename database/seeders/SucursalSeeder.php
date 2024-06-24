<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sucursal::create([
            "nombre"            => "Sucursal 1",
            "direccion"         => "Dirección 1234",
            "entre_calles_1"    => "Calle 1",
            "entre_calles_2"    => "Calle 2",
            "codigo_postal"     => "8000",
            "local"             => "",
            "barrio"            => "",
            "localidad"         => "Bahía Blanca",
            "provincia"         => "Buenos Aires",
            "pais"              => "Argentina",
            "telefono_1"        => "1234567890",
            "telefono_2"        => "9874568753",
            "fax"               => "4797964987",
            "email"             => "sucursal_1@hotmail.com",
            "geolocalizacion"   => "-38.66813382230747,-62.26134132375696",
            "principal"         => True
        ]);

        Sucursal::create([
            "nombre"            => "Sucursal 2",
            "direccion"         => "Dirección 4321",
            "entre_calles_1"    => "",
            "entre_calles_2"    => "",
            "codigo_postal"     => "8000",
            "local"             => "",
            "barrio"            => "",
            "localidad"         => "Bahía Blanca",
            "provincia"         => "Buenos Aires",
            "pais"              => "Argentina",
            "telefono_1"        => "498494",
            "telefono_2"        => "",
            "fax"               => "",
            "email"             => "sucursal_2@hotmail.com",
            "geolocalizacion"   => "-38.66813382230000,-62.26134132375000",
            "principal"         => False
        ]);
    }
}