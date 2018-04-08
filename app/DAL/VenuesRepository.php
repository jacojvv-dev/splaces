<?php

namespace App\DAL;

use App\Venue;


class VenuesRepository
{
    public static function find($id)
    {
        return Venue::whereId($id)->first();
    }

    public static function store($venueToStore)
    {
        // get or create the venue
        $venue = Venue::whereId($venueToStore->id)->first();
        if ($venue == null) {
            $venue = new Venue([
                'id' => $venueToStore->id,
                'data' => json_encode($venueToStore)
            ]);
            $venue->save();
        }


        return $venue;
    }
}