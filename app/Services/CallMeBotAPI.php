<?php

namespace App\Services;

class CallMeBotAPI
{
    private $apiKey;
    private $phoneNumber;

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function __construct($apiKey, $phoneNumber)
    {
        $this->apiKey       = $apiKey;
        $this->phoneNumber  = $phoneNumber;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function sendWhatsapp($message)
    {
        $url='https://api.callmebot.com/whatsapp.php?source=php&phone='.$this->phoneNumber.'&text='.urlencode($message).'&apikey='.$this->apiKey;

        if($ch = curl_init($url))
        {
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $html = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            // echo "Output:".$html;  // you can print the output for troubleshooting
            curl_close($ch);
            return (int) $status;
        }
        else
        {
            return false;
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
