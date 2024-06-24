<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Newsletter;
class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Newsletter::create([
            "email"         => "usuariodeprueba@hotmail.com",
            "fecha_alta"    => now(),
            "estado"        => 1
        ]);
    }
}
