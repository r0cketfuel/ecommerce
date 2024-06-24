<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\CuentaBancaria;

class CuentaBancariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CuentaBancaria::create([
            "banco"     => "ICBC",
            "cuit"      => "20314391102",
            "titular"   => "Fernando Pizzuti",
            "cuenta"    => "0539/01124496/42",
            "cbu"       => "0150539901000124496429",
            "alias"     => "POETA.BOCINA.MANO",
        ]);
    }
}
