<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenEstado extends Model
{
    protected $table        = 'ordenes_estados';
    public $timestamps      = false;

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
