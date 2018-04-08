<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VenueView
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $venue_id
 * @property string $venue_name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VenueView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VenueView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VenueView whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VenueView whereVenueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VenueView whereVenueName($value)
 */
class VenueView extends Model
{
    protected $fillable = [
        'venue_id', 'venue_name'
    ];
}
