<?php

    namespace App\Services;

    use App\Models\Articulo;
    use App\Models\AtributoArticulo;

    class ShoppingCartService
    {
        const SESSION_CART_KEY          = "shop.usuario.carrito";
        const SESSION_CART_ITEMS_KEY    = "shop.usuario.carrito.items";
        
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function __construct()
        {
            if(!session()->has(self::SESSION_CART_KEY))
                $this->init();
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function init(): int
        {
			//=============================================//
			// Método que inicializa el carrito de compras //
			//=============================================//

            session()->put(self::SESSION_CART_KEY,          []);
            session()->put(self::SESSION_CART_ITEMS_KEY,    []);

            return $this->totalItems();
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function itemIndex(int $id, int $atributos_id): int
        {
            //==============================================================//
            // Método que devuelve el índice del arreglo donde esta el item //
            //==============================================================//

            for($i=0;$i<count(session(self::SESSION_CART_ITEMS_KEY));$i++)
                if(session(self::SESSION_CART_ITEMS_KEY)[$i]["id"] == $id && session(self::SESSION_CART_ITEMS_KEY)[$i]["atributos_id"] == $atributos_id)
                    return $i;

            return -1;
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function updateCart(int $id, int $cantidad, int $atributos_id)
        {
            //============================================//
            // Método que actualiza el carrito de compras //
            //============================================//

            if($id>0 && $cantidad>=0)
            {
                $articulo       = Articulo::with(['atributo' => function($query) use ($atributos_id) {$query->where('id', $atributos_id);}])->find($id);

                $limiteCompra   = AtributoArticulo::maximoCompra($articulo->atributo[0]->id);
                $index          = $this->itemIndex($id, $articulo->atributo[0]->id);

                if($index<0)
                {
                    // Agregar item al carrito
                    if($cantidad<=$limiteCompra && $cantidad>0)
                        $this->addItem($articulo, $articulo->atributo[0], $cantidad);
                }
                else
                {
                    // Actualizar o eliminar item del carrito
                    if($cantidad<=$limiteCompra && $cantidad>0)
                        $this->updateItem($index, $cantidad);
                    else
                        $this->removeItem($index);
                }
            }

            return $this->totalItems();
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function addItem($articulo, $atributoArticulo, int $cantidad)
        {
            //=====================================================//
            // Método que inserta un item en el carrito de compras //
            //=====================================================//
            
            session()->push(self::SESSION_CART_ITEMS_KEY, [
                "id"            => $articulo->id,
                "nombre"        => $articulo->nombre,
                "imagen"        => count($articulo->imagen) ? $articulo->imagen[0]["miniatura"] : NULL,
                "atributos_id"  => $atributoArticulo->id,
                "cantidad"      => $cantidad
            ]);
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function updateItem(int $index, int $cantidad)
        {
            //======================================================================//
            // Método que actualiza la cantidad de un item en el carrito de compras //
            //======================================================================//

            session()->put(self::SESSION_CART_ITEMS_KEY . ".$index.cantidad", $cantidad);
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function removeItem(int $index)
        {
            //===================================================//
            // Método que elimina un item del carrito de compras //
            //===================================================//

            $sessionKey     = self::SESSION_CART_ITEMS_KEY;
            $sessionItems   = session($sessionKey);

            if(isset($sessionItems[$index]))
            {
                array_splice($sessionItems, $index, 1);
                session([$sessionKey => $sessionItems]);
            }
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function checkOut(): array
        {
            $chekOutArray = [
                "items" => session(self::SESSION_CART_ITEMS_KEY),
                "total" => 0
            ];
        
            foreach ($chekOutArray["items"] as &$item)
            {
                $articulo   = Articulo::find($item["id"]);
                $precio     = $articulo->precioConDescuento;
                $cantidad   = $item["cantidad"];
                $subtotal   = $precio * $cantidad;
        
                $item["precio"]     = $precio;
                $item["subtotal"]   = $subtotal;
                $item["opciones"]   = [];
        
                $chekOutArray["total"] += $subtotal;
            }
        
            return $chekOutArray;
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function total(): float
        {
            $checkoutData = $this->checkOut();

            return $checkoutData["total"];
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function totalItems(): int
        {
            //====================================================//
            // Método que retorna el total de items en el carrito //
            //====================================================//

            $total = 0;
            for($i=0;$i<count(session(self::SESSION_CART_ITEMS_KEY));$i++)
                $total += session(self::SESSION_CART_ITEMS_KEY)[$i]["cantidad"];

            return $total;
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    }