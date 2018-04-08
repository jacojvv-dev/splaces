<?php

namespace App\DAL;

use App\Photo;

class PhotoRepository
{
    /**
     * Find photos stored for a location
     * @param $location
     * @return mixed
     */
    public static function find($location)
    {
        return Photo::whereLocation($location)->first();
    }

    /**
     * Store photo data for a location
     * @param $location
     * @param $data
     * @return Photo|mixed
     */
    public static function store($location, $data)
    {
        $photo = PhotoRepository::find($location);
        if ($photo == null) {
            $photo = new Photo([
                'location' => $location,
                'data' => $data
            ]);
            $photo->save();
        }

        return $photo;
    }
}