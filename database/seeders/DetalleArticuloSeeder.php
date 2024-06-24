<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetalleArticulo;

class DetalleArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $review = 
        "<h1>Descripción:</h1>
        <p>Taza de cerámica hecha a mano, perfecta para compartir un café, té, smoothie o cualquier infusión. Esta pieza le dará a tus rituales cotidianos un toque artístico, canchero y único. Proba combinarlos con nuestros platos y set de bowls, ideales para acompañar con algo rico tus meriendas y desayunos.</p>
        <h2>Materiales:</h2>
        <p>Cada pieza es realizada con arcilla blanca, modelada en moldes de yeso, esmaltada en forma artesanal, con un acabado brillante y pintada a mano (en caso que estén pintadas). Todos los objetos realizados en MARLA, son aptos para el consumo de cualquier alimento, ya que se utilizan esmaltes alcalinos. Piezas NO para Microondas.</p>
        <h2>Medidas:</h2>
        <p>Cada pieza es hecha a mano, cualquier variación en las medias o imperfección, refleja el carácter artesanal de la misma.</p>
        <br>
        <p>Ø boca: 7,5cm</p>
        <p>Ø parte mas ancha (sin contar el asa): 9,5 cm</p>
        <p>Alto: 10 cm</p>
        <p>Capacidad: 400cc</p>
        <br>
        <h3>PRODUCTO 100% ARGENTINO</h3>";

        DetalleArticulo::create([
            "articulo_id"   => 1,
            "detalle"       => $review
        ]);
    }
}
