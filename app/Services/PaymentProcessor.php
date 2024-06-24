<?php

    namespace App\Services;

    abstract class PaymentProcessor
    {
        protected $apiKey;

        abstract public function charge($request);

        abstract public function refund($transactionId);

        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function __construct($apiKey)
        {
            $this->apiKey = $apiKey;
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function processPayment($amount, $cardNumber)
        {
            // Realizar tareas comunes de procesamiento aquí, como la validación de datos.

            $response = $this->charge($amount, $cardNumber);

            // Registrar la transacción en la base de datos u otras tareas comunes.

            return $response;
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function processRefund($transactionId)
        {
            // Realizar tareas comunes de procesamiento aquí.

            $response = $this->refund($transactionId);

            // Actualizar el estado de la transacción o realizar otras tareas comunes.

            return $response;
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    }
