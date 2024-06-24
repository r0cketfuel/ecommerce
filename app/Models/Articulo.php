<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulo extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creado';
    const UPDATED_AT = 'actualizado';
    const DELETED_AT = 'eliminado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'subcategoria_id',
        'estado'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'creado',
        'actualizado',
        'eliminado'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function detalle()
    {
        return $this->hasOne(DetalleArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function review()
    {
        return $this->hasMany(Review::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function atributo()
    {
        return $this->hasMany(AtributoArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function imagen()
    {
        return $this->hasMany(ImagenArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function promocion()
    {
        return $this->hasOne(Promocion::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function promocionVigente()
    {
        return $this->hasOne(Promocion::class)->where('valido_desde', '<=', now())->where('valido_hasta', '>=', now());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function scopeArticulosActivos(Builder $query): void
    {
        $query->where('estado', 1);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function info(int $id)
    {
        //=====================================================================//
        // Método que devuelve un artículo con toda la información relacionada //
        //=====================================================================//

        if($id > 0)
        {
            $articulo = self::where('id', $id)
                ->with('atributo.talle')
                ->with('imagen')
                ->with('detalle')
                ->with('categoria')
                ->with('subcategoria')
                ->with('review.usuario')
                ->with('promocionVigente')
                ->first();

            if($articulo)
                return($articulo);
        }
    
        return NULL;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public static function search($search = [])
	{
        //=============================================//
        // Método que devuelve un listado de artículos //
        //=============================================//

        $query = self::ArticulosActivos()->with('imagen')->with('promocionVigente');

        if(isset($search['query']))
        {
            $busqueda = strtolower($search['query']);
            $busqueda = strtr($busqueda, 'áéíóúüñ', 'aeiouun');

            $query->where(function ($q) use ($busqueda)
            {
                $q->where('codigo',         'like', '%' . $busqueda . '%')
                ->orWhere('nombre',         'like', '%' . $busqueda . '%')
                ->orWhere('descripcion',    'like', '%' . $busqueda . '%')
                ->orWhereJsonContains('tags', $busqueda);
            });
        }
    
        if(isset($search['categoria']))
            $query->where('categoria_id', $search['categoria']);
    
        if(isset($search['subcategoria']))
            $query->where('subcategoria_id', $search['subcategoria']);

        if(isset($search['sort']))
            if(isset($search['order']))
                $query->orderBy($search['sort'], $search['order']);
        
        $items = $query->paginate(config('constants.pagination'));
    
        return $items;
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function getPrecioConDescuentoAttribute()
    {
        //=========================================================================================================//
        // Accessor que calcula el precio con descuento cada vez que se accede a la propiedad 'precioConDescuento' //
        //=========================================================================================================//
        
        if($this->promocionVigente)
            return $this->precio - ($this->precio * $this->promocionVigente->descuento / 100);

        return $this->precio;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}