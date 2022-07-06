<?php

namespace App\Helpers;

use DateTime;

class Date
{
    /**
     * @param int|string $date Unix timestamp ou data formatada
     * @return ?string
     */
    public static function hoursElapsedSoFar($date): ?string
    {
        $date = new DateTime(is_int($date) ? date("Y-m-d H:i:s", $date) : $date);
        $diff = $date->diff((new DateTime(date("Y-m-d H:i:s"))));

        $arr = [
            "y" => $diff->y != 0 ? $diff->y . "" . ($diff->y > 0 ? "a" : "a") : null,
            "m" => $diff->m != 0 ? $diff->m . "" . ($diff->m > 0 ? "m" : "m") : null,
            "d" => $diff->d != 0 ? $diff->d . "" . ($diff->d > 0 ? "d" : "d") : null,
            "h" => $diff->h != 0 ? $diff->h . "" . ($diff->h > 0 ? "h" : "h") : null,
            "i" => $diff->i != 0 ? $diff->i . "" . ($diff->i > 0 ? "m" : "m") : null,
            "s" => $diff->s != 0 ? $diff->s . "" . ($diff->s > 0 ? "s" : "s") : null,
        ];

        $hours = implode("", array_map(function ($item) {
            return $item ? "{$item} " : null;
        }, $arr));

        return empty($hours) ? "0s" : $hours;
    }
}
