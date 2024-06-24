<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'fecha',
        'factura_tipo_id',
        'razon_social',
        'apellidos',
        'nombres',
        'tipo_documento_id',
        'documento_nro',
        'cuil',
        'cuit',
        'domicilio',
        'domicilio_nro',
        'domicilio_piso',
        'domicilio_depto',
        'localidad',
        'codigo_postal',
        'envio',
        'items',
        'iva',
        'total',
        'medio_pago_id',
        'cae',
        'cae_vto',
        'factura_estado_id'
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function tipo()
    {
        return $this->belongsTo(FacturaTipo::class, 'factura_tipo_id');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function estado()
    {
        return $this->belongsTo(FacturaEstado::class, 'factura_estado_id');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function medioPago()
    {
        return $this->belongsTo(MedioPago::class, 'medio_pago_id');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

}
