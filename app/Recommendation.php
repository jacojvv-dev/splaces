<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Recommendation
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $location
 * @property string|null $section
 * @property string|null $query
 * @property string $data
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recommendation whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recommendation whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recommendation whereQuery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recommendation whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recommendation whereUpdatedAt($value)
 */
class Recommendation extends Model
{
    protected $fillable = [
        'location', 'section', 'query', 'data'
    ];
}
