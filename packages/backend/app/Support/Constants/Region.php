<?php
namespace App\Support\Constants;

class Region
{
    const NORTH = 'N';
    const NORTHEAST = 'NE';
    const SOUTHEAST = 'SE';
    const MIDWEST = 'CO';
    const SOUTH = 'S';

    static function getAllRegions(): array
    {
        return [
            self::NORTH,
            self::NORTHEAST,
            self::SOUTHEAST,
            self::MIDWEST,
            self::SOUTH,
        ];
    }
}
