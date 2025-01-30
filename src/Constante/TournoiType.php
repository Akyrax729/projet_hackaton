<?php

namespace App\Constant;

class TournoiType
{
    public const ELIMINATION_DIRECTE = 'elimination_directe';
    public const LIGUE = 'ligue';
    public const DOUBLE_ELIMINATION = 'double_elimination';

    public static function getTypes(): array
    {
        return [
            self::ELIMINATION_DIRECTE,
            self::LIGUE,
            self::DOUBLE_ELIMINATION,
        ];
    }
}
