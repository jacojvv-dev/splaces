<?php

namespace App\DAL;

use App\Venue;

class VenuesRepository
{
    /**
     * Finds and returns a stored venue using it's venue id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public static function find($id)
    {
        return Venue::whereId($id)->first();
    }

    /**
     * Saves a venue
     * @param $venueToStore
     * @return VenuesRepository|Venue|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function store($venueToStore)
    {
        $venue = VenuesRepository::find($venueToStore->id);
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