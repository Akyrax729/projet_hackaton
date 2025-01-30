<?php

namespace App\Constant;

class TournoiStatut
{
    public const EN_COURS = 'en_cours';
    public const TERMINE = 'termine';
    public const ANNULE = 'annule';

    public static function getStatuts(): array
    {
        return [
            self::EN_COURS,
            self::TERMINE,
            self::ANNULE,
        ];
    }
}
