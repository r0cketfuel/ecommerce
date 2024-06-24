<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
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
        'imagen',
        'descripcion',
        'link',
        'valido_desde',
        'valido_hasta'
    ];
        
    protected $hidden = [
        'creado',
        'actualizado',
        'eliminado'
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function vigentes()
    {
        //====================================================================================//
        // Método que retorna una colección con los banners promocionales vigentes a la fecha //
        //====================================================================================//

        $banners = Banner::where('valido_desde', '<=', now())->where('valido_hasta', '>=', now())->get();

        foreach ($banners as $banner)
            $banner->imagen = config('constants.banners') . '/' . $banner->imagen;
    
        return $banners;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}