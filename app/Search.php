<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Search
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $location
 * @property string $searched_on
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereSearchedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Search whereUpdatedAt($value)
 */
class Search extends Model
{
    //
}
