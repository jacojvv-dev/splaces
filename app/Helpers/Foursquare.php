<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class Foursquare
{
    private $id;
    private $secret;
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false, // ssl issues, dont use in production
            'base_uri' => 'https://api.foursquare.com/v2/venues/'
        ]);

        $this->id = env('FOURSQUARE_CLIENT_ID');
        $this->secret = env('FOURSQUARE_CLIENT_SECRET');
    }


    /**
     * @param array $params
     * @return string
     */
    private function getParams($params = [])
    {
        $p = '?client_id=' . $this->id . '&client_secret=' . $this->secret . '&v=20180323';
        foreach ($params as $key => $value) {
            $p .= '&' . $key . '=' . $value;
        }
        return $p;
    }

    /**
     * Takes the recommendation response and applies transformations
     * @param $content
     * @return mixed
     */
    private function parseRecommendationResponse($content)
    {
        // parse the body
        $json = json_decode($content);

        foreach ($json->response->groups as $group) {
            foreach ($group->items as $item) {
                // get the full image url of the venue
                if (isset($item->venue->photos) && $item->venue->photos->count > 0) {
                    $firstImage = $item->venue->photos->groups[0]->items[0];
                    $item->fullImageUrl = $firstImage->prefix . $firstImage->width . 'x' . $firstImage->height . $firstImage->suffix;
                } else {
                    $item->fullImageUrl = 'https://via.placeholder.com/640x350?text=' . $item->venue->name;
                }

                // get the top tip
                if (isset($item->tips) && isset($item->tips[0]))
                    $item->topTip = $item->tips[0]->text;
                else
                    $item->topTip = null;
            }
        }

        return $json;
    }

    /**
     * Retrieves venue recommendations
     * @param $location
     * @param null $section
     * @param null $query
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getVenueRecommendations($location, $section = null, $query = null)
    {


        $params = $this->getParams([
            'near' => $location,
            'venuePhotos' => 1,
            'query' => $query,
            'section' => $section
        ]);

        $url = 'explore' . $params;
        $response = $this->client->request('GET', $url);
        return $this->parseRecommendationResponse($response->getBody());
    }


    /**
     * Retrieves a venue by id
     * @param $id
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getVenueById($id)
    {
        $params = $this->getParams();
        $url = $id . $params;

        $response = null;
        try {
            $response = $this->client->request('GET', $url);
        } catch (\Exception $ex) {
            return null;
        }

        $decoded = json_decode($response->getBody());
        if (isset($decoded->response) && isset($decoded->response->venue))
            return $decoded->response->venue;
        else
            return null;
    }


}