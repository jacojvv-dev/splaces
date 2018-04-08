<?php

namespace App\Http\Controllers;

use App\DAL\PhotoRepository;
use App\DAL\RecommendationRepository;
use App\DAL\SearchRepository;
use App\DAL\UserRepository;
use App\DAL\VenuesRepository;
use App\DAL\VenueViewRepository;
use App\DAL\WeatherRepository;
use App\Helpers\Flickr;
use App\Helpers\Foursquare;
use App\Helpers\OpenWeatherMap;
use App\Helpers\Splaces;

class DataController extends Controller
{
    private $foursquare;
    private $openWeatherMap;
    private $flickr;

    public function __construct()
    {
        $this->foursquare = new Foursquare();
        $this->openWeatherMap = new OpenWeatherMap();
        $this->flickr = new Flickr();
    }

    /**
     * Return recommendations for filters
     * @param $location
     * @param null $section
     * @param null $query
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function recommendations($location, $section = null, $query = null)
    {
        $location = trim($location);
        if ($section == 'null') $section = null;
        if ($query == 'null') $query = null;

        // check if we have a cached result set
        $recommendations = RecommendationRepository::find($location, $section, $query);
        if ($recommendations == null) {
            $recommendations = json_encode($this->foursquare->getVenueRecommendations($location, $section, $query)->response);
            RecommendationRepository::store($location, $section, $query, $recommendations);
        } else
            $recommendations = $recommendations->data;

        if (Splaces::isCoordinate($location) === false)
            SearchRepository::store($location);

        return $recommendations;
    }

    /**
     * Retrieves a venue by id
     * @param $id
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function venue($id)
    {
        // try find cached venue first
        $venue = VenuesRepository::find($id);
        if ($venue != null) {
            VenueViewRepository::store($id, json_decode($venue->data)->name);
            return ($venue->data);
        }

        $venue = $this->foursquare->getVenueById($id);
        if ($venue == null)
            abort(404);

        VenuesRepository::store($venue);
        VenueViewRepository::store($id, $venue->name);

        return json_encode($venue);
    }

    /**
     * Retrieves weather for a query
     * @param $location
     * @return \Psr\Http\Message\StreamInterface|string
     */
    public function weather($location)
    {
        $weather = WeatherRepository::find($location);
        if ($weather != null)
            return $weather->data;

        $weather = $this->openWeatherMap->getWeatherForSearch($location);
        WeatherRepository::store($location, $weather);
        return $weather;
    }

    /**
     * Retrieves photos for a query
     * @param $location
     * @return mixed|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function photos($location)
    {
        $photos = PhotoRepository::find($location);
        if ($photos != null)
            return $photos->data;

        $photos = $this->flickr->getPhotos($location);
        PhotoRepository::store($location, $photos);
        return $photos;
    }

    /**
     * Retrieve the latest searches
     * @return mixed
     */
    public function latestSearches()
    {
        return SearchRepository::latest();
    }

    /**
     * Retrieve the latest venue views
     * @return mixed
     */
    public function latestVenueViews()
    {
        return VenueViewRepository::latest();
    }

    /**
     * Retrieves the current user
     * @return mixed
     */
    public function user()
    {
        return UserRepository::find(request()->user()->id);
    }

    /**
     * Adds a venue for a user
     * @return UserRepository|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function addUserVenue()
    {
        $id = request('id');
        $name = request('name');

        return UserRepository::addUserVenue(request()->user()->id, $id, $name);
    }

    /**
     * Removes a venue for a user
     * @return UserRepository|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function removeUserVenue()
    {
        $id = request('id');
        return UserRepository::removeUserVenue(request()->user()->id, $id);
    }


}
