<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Services\ShoppingCartService;

use App\Models\Articulo;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Orden;
use App\Models\PagoMercadoPago;
use App\Models\TipoDocumento;
use App\Services\CallMeBotAPI;
use App\Services\MercadoPago;

class PaymentController extends Controller
{
    private $medioPagoId;
    private $checkout;
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    private function getDataFromRequest(Request $request)
    {
        $data = $request->hasHeader("Content-Type") && $request->header("Content-Type") === "application/json"
            ? json_decode(file_get_contents("php://input"), true)
            : $request->all();
    
        return $data;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    private function prepareItemsMp()
    {
        $itemsMp = [];
    
        foreach ($this->checkout["items"] as $item)
        {
            $info = Articulo::info($item["id"]);
    
            $itemsMp[] = [
                "id"            => $info["id"],
                "title"         => $info["descripcion"],
                "description"   => "",
                "picture_url"   => null,
                "category_id"   => "",
                "quantity"      => $item["cantidad"],
                "unit_price"    => $info["precio"],
            ];
        }
    
        return $itemsMp;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function process_payment(Request $request, ShoppingCartService $shoppingCart)
    {
        $this->medioPagoId  = session("shop.checkout.medio_pago.id");
        $this->checkout     = $shoppingCart->checkOut();
    
        $itemsMp    = $this->prepareItemsMp();

        //DESCONTAR STOCK
        //$articulo_id = Articulo::where("talle_id", $talle_id)->where("color", $color)["id"];
        //Articulo::modificaStock($articulo_id, $stock - $cantidad);

        $data = $this->getDataFromRequest($request);

        switch($this->medioPagoId)
        {            
            case(1):
            case(2):
                $this->crearFacturas($data);
                return redirect("/shop/success");
                break;

            case(3):
                $this->debitoCredito($data, $itemsMp);
                break;

            case(4):
                $response = $this->pagofacil($data, $itemsMp);
                return redirect("/shop/success");
                break;

            case(5):
                $response = $this->rapipago($data, $itemsMp);
                return redirect("/shop/success");
                break;
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function debitoCredito($data, $itemsMp)
    {
        $parametros = array(
            "issuer_id"                 => (int)$data["issuer_id"],
            "description"               => $data["description"],
            "external_reference"        => "Referencia externa",
            "token"                     => $data["token"],
            "installments"              => (int)$data["installments"],
            "payer"                     => array(
                "email"                 => $data["payer"]["email"],
                "identification"        => array(
                    "type"              => $data["payer"]["identification"]["type"],
                    "number"            => $data["payer"]["identification"]["number"]
                    )
            ),
            "payment_method_id"         => $data["payment_method_id"],
            "transaction_amount"        => (float)session("shop.checkout.total"),
            "additional_info"           => array(
                "items"                 => $itemsMp,
                "payer"                 => array(
                    "first_name"        => $data["apellidos"],
                    "last_name"         => $data["nombres"],
                    "phone"             => array("area_code"=>"11","number"=>"4403698"),
                ),
                "shipments"             => array(
                    "receiver_address"  => array(
                        "zip_code"      => "12312-123",
                        "state_name"    => "Rio de Janeiro",
                        "city_name"     => "Buzios",
                        "street_name"   => "Av das Nacoes Unidas",
                        "street_number" => 3003,
                    ),
                ),
            ),
        );

        $mercadoPago    = new MercadoPago(env('MERCADOPAGO_ACCESS_TOKEN'));
        $response       = $mercadoPago->charge($parametros);

        if($response["success"] == True)
        {
            if($response["data"]["payment"]->status==="approved")
            {
                $facturaId = $this->crearFacturas($data);
                
                PagoMercadoPago::create([
                    "mercadopago_id"    => $response["data"]["payment"]->id,
                    "factura_id"        => $facturaId
                ]);
            }
        }


        // Respuesta de la api
        echo json_encode($response);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function pagofacil($data, $itemsMp)
    {
        if($this->medioPagoId==4 || $this->medioPagoId==5)
        {
            if($this->medioPagoId==4) $payment_method_id = "pagofacil";
            if($this->medioPagoId==5) $payment_method_id = "rapipago";

            $parametros = array(
                "description"               => "Descripción",
                "external_reference"        => "Referencia externa",
                "payer"                     => array(
                    "email"                 => $data["email"],
                    "identification"        => array(
                        "type"              => $data["tipo_documento_id"],
                        "number"            => $data["documento_nro"]
                    )
                ),
                "payment_method_id"         => $payment_method_id,
                "transaction_amount"        => (float)session("shop.checkout.total"),
                "additional_info"           => array(
                    "items"                 => $itemsMp,
                    "payer"                 => array(
                        "first_name"        => $data["apellidos"],
                        "last_name"         => $data["nombres"],
                        "phone"             => array("area_code"=>"11","number"=>"4403698"),
                    ),
                    "shipments"             => array(
                        "receiver_address"  => array(
                            "zip_code"      => "12312-123",
                            "state_name"    => "Rio de Janeiro",
                            "city_name"     => "Buzios",
                            "street_name"   => "Av das Nacoes Unidas",
                            "street_number" => 3003,
                        ),
                    ),
                ),
            );

            $mercadoPago    = new MercadoPago(env('MERCADOPAGO_ACCESS_TOKEN'));
            $response       = $mercadoPago->charge($parametros);
            
            $facturaId      = $this->crearFacturas($data);

            PagoMercadoPago::create([
                "mercadopago_id"    => $response["data"]["payment"]->id,
                "factura_id"        => $facturaId
            ]);
            
            return($response);
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function rapipago($data, $itemsMp)
    {
        if($this->medioPagoId==4 || $this->medioPagoId==5)
        {
            if($this->medioPagoId==4) $payment_method_id = "pagofacil";
            if($this->medioPagoId==5) $payment_method_id = "rapipago";

            $parametros = array(
                "description"               => "Descripción",
                "external_reference"        => "Referencia externa",
                "payer"                     => array(
                    "email"                 => $data["email"],
                    "identification"        => array(
                        "type"              => $data["tipo_documento_id"],
                        "number"            => $data["documento_nro"]
                    )
                ),
                "payment_method_id"         => $payment_method_id,
                "transaction_amount"        => (float)session("shop.checkout.total"),
                "additional_info"           => array(
                    "items"                 => $itemsMp,
                    "payer"                 => array(
                        "first_name"        => $data["apellidos"],
                        "last_name"         => $data["nombres"],
                        "phone"             => array("area_code"=>"11","number"=>"4403698"),
                    ),
                    "shipments"             => array(
                        "receiver_address"  => array(
                            "zip_code"      => "12312-123",
                            "state_name"    => "Rio de Janeiro",
                            "city_name"     => "Buzios",
                            "street_name"   => "Av das Nacoes Unidas",
                            "street_number" => 3003,
                        ),
                    ),
                ),
            );

            $mercadoPago    = new MercadoPago(env('MERCADOPAGO_ACCESS_TOKEN'));
            $response       = $mercadoPago->charge($parametros);

            $facturaId      = $this->crearFacturas($data);

            PagoMercadoPago::create([
                "mercadopago_id"    => $response["data"]["payment"]->id,
                "factura_id"        => $facturaId
            ]);

            return($response);
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function crearFacturas($fields)
    {
        //======================================================//
        // Método que crea la factura y el detalle de la compra //
        //======================================================//

        // Solución al cambio atributo 'value' que modifica el script de mercadopago
        if(!is_numeric($fields["tipo_documento_id"]))
            $tipoDocumentoId = TipoDocumento::search($fields["tipo_documento_id"])["id"];
        else
            $tipoDocumentoId = $fields["tipo_documento_id"];

        DB::beginTransaction();

        try
        {
            $factura = Factura::create([
                "fecha"             => now(),
                "factura_tipo_id"   => 1,
                'razon_social'      => $fields["razon_social"]  ?? NULL,
                "apellidos"         => $fields["apellidos"]     ?? NULL,
                "nombres"           => $fields["nombres"]       ?? NULL,
                "tipo_documento_id" => $tipoDocumentoId         ?? NULL,
                "documento_nro"     => $fields["documento_nro"] ?? NULL,
                'cuil'              => $fields["cuil"]          ?? NULL,
                'cuit'              => $fields["cuit"]          ?? NULL,
                "domicilio"         => $fields["domicilio"],
                "domicilio_nro"     => $fields["domicilio_nro"],
                "domicilio_piso"    => $fields["domicilio_piso"],
                "domicilio_depto"   => $fields["domicilio_depto"],
                "localidad"         => $fields["localidad"],
                "codigo_postal"     => $fields["codigo_postal"],
                "envio"             => session("shop.checkout.medio_envio.costo") ?? 0,
                "items"             => session("shop.checkout.total"),
                "iva"               => (float)session("shop.checkout.total") - ((float)session("shop.checkout.total") * 0.21),
                "total"             => (float)session("shop.checkout.total") + (float)session("shop.checkout.medio_envio.costo"),
                "medio_pago_id"     => session("shop.checkout.medio_pago.id"),
                "cae"               => "",
                "cae_vto"           => "2099-01-01",
                "factura_estado_id" => 1,
            ]);

            $orden = Orden::create([
                "factura_id"        => $factura->id,
                "estado_id"         => 1,
            ]);

            // Creación del detalle de la factura
            foreach ($this->checkout["items"] as $item)
            {
                $articulo = Articulo::info($item["id"]);
            
                $factura = FacturaDetalle::create([
                    "factura_id"    => $factura->id,
                    "articulo_id"   => $articulo->id,
                    "precio"        => $articulo->precio,
                    "cantidad"      => $item["cantidad"],
                    "subtotal"      => (float)$articulo->precio * $item["cantidad"]
                ]);
            }            

            DB::commit();
            $callMeBotApi = new CallMeBotAPI(env('CALL_ME_BOT_API_KEY'), "+5492914403921");
            $callMeBotApi->sendWhatsapp("Ha ingresado una compra. Se ha generado la factura Nro: " . $factura->id . " y la orden Nro: " . $orden->id);
        }
        catch (\Exception $e)
        {
            DB::rollback();
            throw $e;
        }
    
        return $factura->id;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
