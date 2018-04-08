<?php

namespace App\Helpers;


use GuzzleHttp\Client;

class OpenWeatherMap
{


    private $key;
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false, // ssl issues, dont use in production
            'base_uri' => 'https://api.openweathermap.org/data/2.5/weather'
        ]);

        $this->key = env('OPEN_WEATHER_MAP_API_KEY');
    }


    /**
     * @param array $params
     * @return string
     */
    private function getParams($params = [])
    {
        $p = '?APPID=' . $this->key . '&units=metric';
        foreach ($params as $key => $value) {
            $p .= '&' . $key . '=' . $value;
        }
        return $p;
    }


    public function getWeatherForSearch($search)
    {
        // check if it is a coord
        if (Splaces::isCoordinate($search) === true) {
            $parts = explode(',', $search);
            $p = $this->getParams([
                'lat' => $parts[0],
                'lon' => $parts[1]
            ]);
            return $this->client->get($p)->getBody();
        }


        $p = $this->getParams([
            'q' => $search
        ]);

        return $this->client->get($p)->getBody();
    }


}