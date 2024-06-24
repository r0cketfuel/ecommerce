<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\InfoComercio;

class InfoComercioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InfoComercio::create([
            "nombre"            => "Nombre del comercio",
            "slogan"            => "Slogan del comercio",
            "descripcion"       => "Descripción del comercio",
            "facebook" 	        => "https://www.facebook.com",
            "twitter" 	        => "https://www.twitter.com",
            "instagram"     	=> "https://www.instagram.com",
            "pinterest" 	    => "https://www.pinterest.com",
            "tiktok"            => "https://www.tiktok.com/",
            "whatsapp"          => "+5492914403921"
        ]);
    }
}
