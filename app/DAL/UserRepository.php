<?php

namespace App\DAL;

use App\User;
use App\UserVenue;

class UserRepository
{
    /**
     * Finds a user ny id, includes relations
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public static function find($id)
    {
        return User::with('venues')->where('id', '=', $id)->first();
    }

    /**
     * Adds a venue for a user
     * @param $id
     * @param $venueId
     * @param $venueName
     * @return UserRepository|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function addUserVenue($id, $venueId, $venueName)
    {
        $user = UserRepository::find($id);

        $newVenue = new UserVenue();
        $newVenue->venue_name = $venueName;
        $newVenue->venue_id = $venueId;
        $user->venues()->save($newVenue);

        return UserRepository::find($id);
    }

    /**
     * Removes a venue for a user
     * @param $id
     * @param $venueId
     * @return UserRepository|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function removeUserVenue($id, $venueId)
    {
        $user = UserRepository::find($id);
        $user->venues()->where('venue_id', '=', $venueId)->delete();
        return UserRepository::find($id);
    }

}