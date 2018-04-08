<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Weather
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $location
 * @property string $data
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Weather whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Weather whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Weather whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Weather whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Weather whereUpdatedAt($value)
 */
class Weather extends Model
{
    protected $fillable = [
        'location', 'data'
    ];
}
