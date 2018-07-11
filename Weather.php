<?php

use GuzzleHttp\Client;

class Weather{
    protected $key = "a7c91ae4b3a2efb0f3c81630aa5db7ff";

    public function getWeather($name){
       $url = "api.openweathermap.org/data/2.5/weather";

       $param = [];
        $param['q'] = $name;
       $param['APPID'] = $this->key;

       $url .= "?".http_build_query($param);
       $client = new Client(['base_uri' => $url]);

       $result = $client->request('GET');

       return json_decode($result->getBody());

    }
}