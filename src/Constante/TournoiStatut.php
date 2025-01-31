<?php

namespace App\Constant;

class TournoiStatut
{
    public const EN_COURS = 'En cours';
    public const TERMINE = 'Terminé';
    public const ANNULE = 'Annulé';

    public static function getStatuts(): array
    {
        return [
            self::EN_COURS,
            self::TERMINE,
            self::ANNULE,
        ];
    }
}
