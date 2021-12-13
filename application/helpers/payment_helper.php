<?php

if (!function_exists('get_current_btcusd')) {
    function get_current_btcusd()
    {
        //get current exchange rate
        //$url = "https://www.bitstamp.net/api/v2/ticker/BTCUSD";
        $url = "https://blockchain.info/ticker";
        $json = getCurl_GET($url);
        if ($json != null && array_key_exists("USD", $json)) {
            $price = $json->USD->last;
            return $price;
        } else {
            //likely an error try another source
            $url = "https://blockchain.info/stats?format=json";
            $json = getCurl_GET($url);
            if ($json != null && array_key_exists("market_price_usd", $json)) {
                $price = $json->market_price_usd;
                return $price;
            } else {
                //both sources unsuccesful 
                return false;
            }
        }
    }
}

if (!function_exists('usd_to_btc')) {
    function usd_to_btc($amount, $currency = 'USD')
    {
        $url = "https://blockchain.info/tobtc?currency=$currency&value=$amount";
        $json = getCurl_GET($url);
        return $json;
    }
}

if (!function_exists('call_bitcoin_payment')) {
    function call_bitcoin_payment($callback_url)
    {

        $receive_url = "https://api.blockchain.info/v2/receive?key=" . BITCOIN_API_KEY . "&xpub=" . BITCOIN_XPUB . "&callback=" . urlencode($callback_url)."&gap_limit=".GAP_LIMIT;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $receive_url);
        $ccc = curl_exec($ch);
        $json = json_decode($ccc, true);
        return $json;
    }
}

if (!function_exists('getCurl_GET')) {
    function getCurl_GET($apiURL)
    {
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array('Content-Type: application/json'));

        $json_response = curl_exec($ch);
        $response = json_decode($json_response);
        return $response;
    }
}