<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Venue
 *
 * @mixin \Eloquent
 * @property string $id
 * @property string $data
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereUpdatedAt($value)
 */
class Venue extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'data'
    ];
}
