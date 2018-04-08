<?php
/**
 * Created by PhpStorm.
 * User: jaco
 * Date: 2018/04/07
 * Time: 3:35 PM
 */

namespace App\Helpers;


class Splaces
{
    /**
     * Test if a value is a coordinate
     * @param $value
     * @return bool
     */
    public static function isCoordinate($value)
    {
        if (preg_match('~[0-9]~', $value) === 1) {
            $parts = explode(',', $value);
            if (count($parts) === 2) {
                if (is_numeric($parts[0]) && is_numeric($parts[1])) {
                    return true;
                }
            }
        }
        return false;
    }
}