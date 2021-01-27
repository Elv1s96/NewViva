<?php


namespace App\Http\Services;


class ExchangeRates
{
    public static function getExchangeRates($baseCurrency)
    {
        $url = "https://api.exchangeratesapi.io/latest";

        if ($baseCurrency) {
            $url .= "?base=$baseCurrency";
        }
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($curl_response, true);
        return $response['rates'];
    }
}
