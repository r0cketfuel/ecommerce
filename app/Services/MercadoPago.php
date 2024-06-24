<?php

    namespace App\Services;

    use MercadoPago\Client\Payment\PaymentClient;
    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\MercadoPagoConfig;
    use App\Services\PaymentProcessor;

    class MercadoPago extends PaymentProcessor
    {
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function __construct($apiKey)
        {
            parent::__construct($apiKey);

            MercadoPagoConfig::setAccessToken($this->apiKey);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function charge($request)
        {
            $client = new PaymentClient();

            try
            {
                $payment = $client->create($request);
                
                return [
                    "success"       => True, 
                    "data"          => [
                        "payment"   => $payment
                    ]
                ];
            }
            catch (MPApiException $e)
            {
                return ["success" => False, "data" => ["exception" => $e]];
            }
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function refund($transactionId)
        {
            // Lógica específica de MercadoPago para realizar un reembolso.
            // Implementa la lógica para procesar el reembolso según tus necesidades.
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function infoPago($id)
        {
            //==================================================================//
            // Consulta toda la información de un pago a través del id del pago //
            //==================================================================//

            $client = new PaymentClient();
        
            try
            {
                $payment = $client->get($id);
                
                return [
                    "success"       => True, 
                    "data"          => [
                        "payment"   => $payment
                    ]
                ];
            }
            catch (MPApiException $e)
            {
                return ["success" => False, "data" => ["exception" => $e]];
            }
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    }
