<?php

namespace App\DAL;

use App\Weather;
use Carbon\Carbon;

class WeatherRepository
{
    /**
     * Finds stored weather for a location
     * @param $location
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public static function find($location)
    {
        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        return Weather::where([
            ['location', '=', $location],
            ['created_at', '>=', Carbon::now()->addMinutes(-15)] //invalidate after set time
        ])->first();
    }

    /**
     * Saves the weather results for a query
     * @param $location
     * @param $data
     * @return WeatherRepository|Weather|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function store($location, $data)
    {
        $weather = WeatherRepository::find($location);
        if ($weather == null) {
            $weather = new Weather([
                'location' => $location,
                'data' => $data
            ]);
            $weather->save();
        }

        return $weather;
    }
}