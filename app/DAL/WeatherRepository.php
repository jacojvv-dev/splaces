<?php
/**
 * Created by PhpStorm.
 * User: jaco
 * Date: 2018/04/07
 * Time: 2:16 PM
 */

namespace App\DAL;


use App\Weather;
use Carbon\Carbon;

class WeatherRepository
{
    public static function find($location)
    {
        return Weather::where([
            ['location', '=', $location],
            ['created_at', '>=', Carbon::now()->addMinutes(-15)] //invalidate after set time
        ])->first();
    }

    public static function store($location, $data)
    {
        // get or create the venue
        $weather = Weather::where([
            ['location', '=', $location],
            ['created_at', '>=', Carbon::now()->addMinutes(-15)] //invalidate after set time
        ])->first();

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