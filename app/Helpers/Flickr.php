<?php


namespace App\Helpers;


use GuzzleHttp\Client;

class Flickr
{
    private $key;
    private $secret;
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false, // ssl issues, dont use in production
            'base_uri' => 'https://api.flickr.com/services/rest/'
        ]);

        $this->key = env('FLICKR_KEY');
        $this->secret = env('FLICKR_SECRET');
    }

    /**
     * @param array $params
     * @return string
     */
    private function getParams($params = [])
    {
        $p = '?api_key=' . $this->key . '&format=json';
        foreach ($params as $key => $value) {
            $p .= '&' . $key . '=' . $value;
        }
        return $p;
    }

    /**
     * @param $location
     * @return mixed|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPhotos($location)
    {
        if (Splaces::isCoordinate($location) === true)
            return null;

        $p = $this->getParams([
            'method' => 'flickr.photos.search',
            'content_type' => 1,
            'text' => $location,
            'per_page' => 10,
            'extras' => 'description,url_sq, url_t, url_s, url_q, url_m, url_n, url_z, url_c, url_l, url_o,license,date_taken,owner_name,tags,views',
            'sort' => 'interestingness-desc'
        ]);

        $response = $this->client->request('GET', $p)->getBody();
        // jsonp, ain't it fun!
        $response = str_replace('jsonFlickrApi', '', $response);
        $response = trim($response, "()");
        return $response;
    }


}