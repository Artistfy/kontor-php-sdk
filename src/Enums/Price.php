<?php

namespace Artistfy\Kontor\Enums;

use Exception;

enum Price: string
{
    case FRONT = 'AA';
    case MID = 'MD';
    case DOUBLE = 'AC';
    case LOW = 'AD';
    case EP = 'AS';
    case SIGNLE_VIDEOTRACK = 'AV';
    case FRONT_MAXI = 'MA';
    case MID_MAXI = 'MB';

    public static function validIntPrices(): array
    {
        return [
            129,
            199,
            299,
            399,
            499,
            599,
            699,
            799,
            899,
            999,
            1099,
            1199,
            1299,
            1399,
            1499,
            1599,
        ];
    }

    public static function fromInt(int $price): self
    {
        return match ($price) {
            129, 199 => self::MID_MAXI,
            299 => self::FRONT_MAXI,
            399, 499, 599 => self::EP,
            699, 799, 899, 999, 1099, 1199 => self::LOW,
            1299, 1399, 1499, 1599 => self::DOUBLE,
            default => throw new Exception('No price found for '.$price),
        };
    }

    public static function toInt(string $case): int
    {
        $price = self::from($case);

        return match ($price) {
            self::MID_MAXI => 199,
            self::FRONT_MAXI => 299,
            self::EP => 599,
            self::LOW => 1199,
            self::DOUBLE => 1599,
            default => throw new Exception('No convertable case found for '.$case),
        };
    }

    public static function fromCode(string $code): self
    {
        $code = strtoupper($code);

        return Price::from($code);
    }
}
