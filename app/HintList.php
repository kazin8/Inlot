<?php

namespace App;

use Carbon\Carbon;

class HintList
{

    /**
     * List of user's types.
     *
     * @return array
     */
    public static function getUserTypeList()
    {
        return [
            '1' => 'individual',
            '2' => 'entity'
        ];
    }

    /**
     * Get id of user's type by code.
     *
     * @param $code
     * @return mixed
     */
    public static function getUserTypeByCode($code)
    {
        return array_search($code, self::getUserTypeList());
    }

    /**
     * List of default location's quantums.
     *
     * @return array
     */
    public static function getDefualtLocationList()
    {
        return [
            'region' => 1000000,
            'city' => 1000000
        ];
    }

    /**
     * Get id of quantum of default location by code.
     *
     * @param $code
     * @return mixed
     */
    public static function getDefaultLocation($code)
    {
        return self::getDefualtLocationList()[$code];
    }

    public static function getReleaseDates()
    {
        $dates = [];
        $currentYear = Carbon::now()->format('Y');

        for ($i = $currentYear; $i >= 1930; $i--) {
            $dates[$i] = $i;
        }

        return $dates;
    }

    public static function getDiameters()
    {
        for ($i = 12; $i <= 30; $i++) {
            $diameters[$i] = $i;
        }

        return isset($diameters) ? $diameters : [];
    }

    public static function getProfileWidthValues()
    {
        for ($i = 125; $i <= 395; $i += 10) {
            $values[$i] = $i;
        }

        return isset($values) ? $values : [];
    }

    public static function getProfileHeightValues()
    {
        for ($i = 25; $i <= 95; $i += 5) {
            $values[$i] = $i;
        }

        return isset($values) ? $values : [];
    }

    public static function getRimDiameters()
    {
        for ($i = 7; $i <= 30; $i++) {
            $diameters[$i] = $i;
        }

        return isset($diameters) ? $diameters : [];
    }

    public static function getRimWidthValues()
    {
        for ($i = 4; $i <= 13; $i += 0.5) {
            if (12.5 === $i) {
                continue;
            }

            $values["$i"] = $i;
        }

        return isset($values) ? $values : [];
    }

    public static function getNumberOfHolesValues()
    {
        for ($i = 3; $i <= 10; $i++) {
            $values[$i] = $i;
        }

        return isset($values) ? $values : [];
    }

    public static function getQuantumList()
    {
        return [
            1 => 'шт.',
            2 => 'комплект'
        ];
    }

    public static function getQuantumById($id)
    {
        return self::getQuantumList()[$id];
    }

}