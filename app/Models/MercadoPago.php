<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MercadoPago extends Model
{
    private $url;
    private $accessToken;

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function __construct()
    {
        /* La clave pública sirve para acceder a los recursos que necesita tu frontend. 
        /* Con ella vas a poder recolectar los datos de las tarjetas de crédito y convertirlos en un token representativo que puedes enviar de forma segura a tus servidores para crear un pago.
        /* La clave privada, o Access token, permite llamar al resto de las APIs desde tus servidores. Por ejemplo, para procesar un pago, realizar un reembolso o almacenar tarjetas.
        */

        $this->url          = "https://api.mercadopago.com";
        $this->accessToken  = "TEST-5863225646154122-070718-a6be75d2a1130511aa92f816d6bc83ea-77586685";
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function callAPI($method, $url, $header, $data)
    {
        //==================//
        // Llamada a la api //
        //==================//
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;

            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;

            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                if($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;

            default:
                if($data) $url = sprintf("%s?%s", $this->url . $url, http_build_query($data));
        }

        //OPCIONES
        curl_setopt($curl, CURLOPT_URL, $this->url . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $result = curl_exec($curl);

        //=========================================//
        // Código resultado de la llamada a la api //
        //=========================================//
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        switch($httpcode)
        {
            // case(400): { die(json_encode("Bad request"));            break; }
            // case(405): { die(json_encode("Method not allowed"));     break; }
        }

        curl_close($curl);

        //CONVIERTE EL RESULTADO EN UN ARRAY
        $result = json_decode($result, true);

        return($result);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function crearCliente($arrayDatos)
    {
        //====================================================================================================================================//
        // Realiza la creación de un cliente con todos sus datos para poder guardar las tarjetas que utilice y simplificar el proceso de pago //
        //====================================================================================================================================//

        $method = "POST";
        $url    = "/v1/customers";
        $header = array("Authorization: Bearer " . $this->accessToken);
        $data   = $arrayDatos;

        return($this->callAPI($method, $url, $header, json_encode($data)));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function crearClientePruebas($arrayDatos)
    {
        //====================================================================================================================================//
        // Realiza la creación de un cliente con todos sus datos para poder guardar las tarjetas que utilice y simplificar el proceso de pago //
        //====================================================================================================================================//

        $method = "POST";
        $url    = "/users/test";
        $header = array("Authorization: Bearer " . $this->accessToken, "Content-Type: application/json");
        $data   = $arrayDatos;

        return($this->callAPI($method, $url, $header, json_encode($data)));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function infoCliente($customerId)
    {
        //=====================================================================================//
        // Consulta toda la información de un cliente creado con el id del cliente que quieras //
        //=====================================================================================//

        $method = "GET";
        $url    = "/v1/customers/$customerId";
        $header = array("Authorization: Bearer " . $this->accessToken);
        $data   = NULL;

        return($this->callAPI($method, $url, $header, $data));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function tarjetasCliente($customerId)
    {
        //=============================================================================================================//
        // Consulta el listado de tarjetas almacenadas de un cliente para poder mostrarlas al momento de hacer un pago //
        //=============================================================================================================//

        $method = "GET";
        $url    = "/v1/customers/$customerId/cards";
        $header = array("Authorization: Bearer " . $this->accessToken);
        $data   = NULL;

        return($this->callAPI($method, $url, $header, $data));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function mediosDePago()
    {
        //===============================================================================================================//
        // Consulta todos los medios de pago disponibles y obtén un listado con el detalle de cada uno y sus propiedades //
        //===============================================================================================================//

        $method = "GET";
        $url    = "/v1/payment_methods";
        $header = array("Authorization: Bearer " . $this->accessToken);
        $data   = NULL;

        return($this->callAPI($method, $url, $header, $data));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function crearPago($parametros)
    {
        //===============================================================================================================================================//
        // Realiza la creación de un pago y agrega toda la información que necesites. ten en cuenta de sumar el detalle del pago y los datos del pagador //
        //===============================================================================================================================================//

        //dump(json_encode($parametros,JSON_PRETTY_PRINT));

        $method = "POST";
        $url    = "/v1/payments";
        $header = array("Authorization: Bearer " . $this->accessToken, "Content-Type: application/json");

        return($this->callAPI($method, $url, $header, json_encode($parametros)));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function infoPago($idPago)
    {
        //==================================================================//
        // Consulta toda la información de un pago a través del id del pago //
        //==================================================================//

        $method = "GET";
        $url    = "/v1/payments/$idPago";
        $header = array("Authorization: Bearer " . $this->accessToken);
        $data   = NULL;

        return($this->callAPI($method, $url, $header, $data));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
