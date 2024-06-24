<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    protected $table    = 'cuentas_bancarias';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'banco',
        'cuit',
        'titular',
        'cuenta',
        'cbu',
        'alias'
    ];

}