<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(InfoComercioSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(TipoDocumentoSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(NewsletterSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(UsuarioDomicilioSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(SubcategoriaSeeder::class);
        $this->call(ArticuloSeeder::class);
        $this->call(ImagenArticuloSeeder::class);
        $this->call(DetalleArticuloSeeder::class);
        $this->call(TalleSeeder::class);
        $this->call(AtributoArticuloSeeder::class);
        $this->call(RatingSeeder::class);
        $this->call(PromocionSeeder::class);
        $this->call(CuentaBancariaSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(CuponSeeder::class);
        $this->call(MedioPagoSeeder::class);
        $this->call(MedioEnvioSeeder::class);
        $this->call(FacturaTipoSeeder::class);
        $this->call(AdministradorSeeder::class);
        $this->call(FavoritoSeeder::class);
        $this->call(FacturaEstadoSeeder::class);
        $this->call(MercadopagoSeeder::class);
        $this->call(MarquesinaSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(OrdenEstadoSeeder::class);
    }
}
