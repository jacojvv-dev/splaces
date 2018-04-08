<?php

namespace App\DAL;

use App\Search;
use Carbon\Carbon;

class SearchRepository
{
    /**
     * Find a search by location name
     * @param $location
     * @return mixed
     */
    public static function find($location)
    {
        return Search::whereLocation($location)->first();
    }

    /**
     * Stores a new search
     * @param $location
     * @return Search|mixed
     */
    public static function store($location)
    {
        $search = SearchRepository::find($location);
        if ($search === null) {
            $search = new Search();
            $search->location = $location;
            $search->searched_on = Carbon::now();
            $search->save();
        } else {
            $search->searched_on = Carbon::now();
            $search->save();
        }

        return $search;
    }

    /**
     * Retrieves the latest searches
     * @return mixed
     */
    public static function latest()
    {
        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        return Search::orderBy('searched_on', 'DESC')->skip(0)->take(25)->get();
    }
}