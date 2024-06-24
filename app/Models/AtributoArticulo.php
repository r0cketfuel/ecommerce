<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtributoArticulo extends Model
{
    protected $table    = 'atributos_articulos';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'articulo_id',
        'talle_id',
        'color',
        'compra_min',
        'compra_max',
        'stock',
        'imagen_id'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function talle()
    {
        return $this->belongsTo(Talle::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function search(int $articuloId, array $opciones = array())
    {
        //================================================================//
        // Método que devuelve registros segun los parámetros solicitados //
        //================================================================//
        
        $query = AtributoArticulo::query()->where('articulo_id', $articuloId);
        
        //Relaciones
        $query->with('talle');

        foreach($opciones as $column => $value)
            if($value!=NULL)
                $query->where($column, $value);
        
        return $query->get();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function maximoCompra(int $id)
    {
        //===============================================================================================================//
        // Método que devuelve el máximo de compra de la combinación de un artículo según su stock o su límite de compra //
        //===============================================================================================================//

        $atributoArticulo = self::find($id);

        if($atributoArticulo->compra_max != NULL)
            if($atributoArticulo->compra_max < $atributoArticulo->stock) 
                return($atributoArticulo->compra_max); 
        
        return $atributoArticulo->stock;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function modificaStock(int $id, int $stock): array
    {
        if(self::where('id', $id)->update(['stock' => $stock]))
        {
            return(array(
                'success'   => true,
                'data'      => array(),
            ));
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}