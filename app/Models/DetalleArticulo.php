<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class DetalleArticulo extends Model
{
    const CREATED_AT    = 'creado';
    const UPDATED_AT    = 'actualizado';

    protected $table    = 'detalles_articulos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'articulo_id',
        'detalle'
    ];
    
    protected $hidden = [
        'creado',
        'actualizado',
        'eliminado'
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        return($this->belongsTo(Articulo::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function detalle(int $id)
    {
        //==========================================//
        // Método que carga el detalle del artículo //
        //==========================================//
        return(self::where('articulo_id', $id)->first());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

}
