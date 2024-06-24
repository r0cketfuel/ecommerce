<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaEstado extends Model
{
    protected $table    = 'facturas_estados';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'estado'
    ];

}
