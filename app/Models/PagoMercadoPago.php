<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoMercadoPago extends Model
{
    protected $table    = 'pagos_mercadopago';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'mercadopago_id',
        'factura_id'
    ];

}
