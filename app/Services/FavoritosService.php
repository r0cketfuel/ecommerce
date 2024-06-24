<?php

    namespace App\Services;

    use App\Models\Favorito;

    class FavoritosService
    {
        const SESSION_FAVOURITES_KEY = "shop.usuario.favoritos";

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function __construct()
		{
            if(!session()->has(self::SESSION_FAVOURITES_KEY))
                $this->init();
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function init(): int
        {
			//=====================================//
			// Método que inicializa los favoritos //
			//=====================================//

            session()->put(self::SESSION_FAVOURITES_KEY, []);

            return $this->totalItems();
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function totalItems(): int
        {
            //============================================================//
            // Método que retorna el total de items agregados a favoritos //
            //============================================================//

            return count(session(self::SESSION_FAVOURITES_KEY));
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function load(int $usuario_id): void
        {
            //============================================================//
            // Método que carga en sesión los items agregados a favoritos //
            //============================================================//

            session()->put(self::SESSION_FAVOURITES_KEY, Favorito::where("usuario_id", $usuario_id)->get()->toArray());
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function addItem(int $usuario_id, int $articulo_id): array
        {
            //===================================================//
            // Método que agrega un item al listado de favoritos //
            //===================================================//

            // Verificar si el item ya se encontraba agregado a favoritos
            if(Favorito::where("usuario_id", $usuario_id)->where("articulo_id", $articulo_id)->withTrashed()->count())
            {
                Favorito::where("usuario_id", $usuario_id)->where("articulo_id", $articulo_id)->restore();

                $this->init();
                $this->load($usuario_id);

                $response   = array(
                    "success"       => false,
                    "data"          => array(
                        "message"   => "El item ya se encontraba en tus favoritos",
                        "itemQty"   => $this->totalItems()
                    ),
                );
                
                return($response);
            }
            
            $favorito = Favorito::create([
                "usuario_id"   => $usuario_id,
                "articulo_id"  => $articulo_id
            ]);

            if($favorito)
            {
                session()->push("shop.usuario.favoritos", $favorito->where("usuario_id", $usuario_id)->where("articulo_id", $articulo_id)->first());

                $response = array(
                    "success"       => true,
                    "data"          => array(
                        "message"   => "El item se agregó a favoritos",
                        "itemQty"   => $this->totalItems()
                    )
                );

                return($response);
            }
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function removeItem(int $usuario_id, int $articulo_id): array
        {
            //=====================================================//
            // Método que elimina un item del listado de favoritos //
            //=====================================================//

            $response = array(
                "success"       => false,
                "data"          => array(
                    "message"   => "No se pudo eliminar el item"
                )
            );

            for($i=0;$i<count(session("shop.usuario.favoritos"));$i++)
                if(session("shop.usuario.favoritos.$i.usuario_id")==$usuario_id && session("shop.usuario.favoritos.$i.articulo_id")==$articulo_id)
                {
                    $favorito = new Favorito;

                    if($favorito->where("usuario_id", $usuario_id)->where("articulo_id", $articulo_id)->delete())
                    {
                        // Recargar todos los favoritos
                        session()->forget("shop.usuario.favoritos");
                        $this->load($usuario_id);
                        
                        $response = array(
                            "success"       => true,
                            "data"          => array(
                                "message"   => "El item se eliminó correctamente",
                                "itemQty"   => $this->totalItems()
                            )
                        );
    
                        break;
                    }
                }
            
            return($response);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function items()
        {
            return session(self::SESSION_FAVOURITES_KEY);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    }