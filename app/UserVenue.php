<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserVenue
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $venue_name
 * @property int $user_id
 * @property string $venue_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserVenue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserVenue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserVenue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserVenue whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserVenue whereVenueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserVenue whereVenueName($value)
 */
class UserVenue extends Model
{
    //
}
