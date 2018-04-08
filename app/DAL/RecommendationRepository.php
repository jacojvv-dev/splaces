<?php

namespace App\DAL;

use App\Recommendation;

class RecommendationRepository
{
    /**
     * Finds the first recommendation for the given criteria, will return null if nothing is found
     * @param $location
     * @param $section
     * @param $query
     * @return mixed
     */
    public static function find($location, $section, $query)
    {
        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        return Recommendation::where([
            ['location', '=', $location],
            ['section', '=', $section],
            ['query', '=', $query]
        ])->orderBy('id', 'DESC')->first();
    }

    /**
     * Stores recommendation results from foursquare, will return stored result when done
     * @param $location
     * @param $section
     * @param $query
     * @param $data
     * @return Recommendation
     */
    public static function store($location, $section, $query, $data)
    {
        $recommendation = RecommendationRepository::find($location, $section, $query);
        if ($recommendation == null) {
            $recommendation = new Recommendation([
                'location' => $location,
                'section' => $section,
                'query' => $query,
                'data' => $data
            ]);
            $recommendation->save();
        }

        return $recommendation;
    }
}