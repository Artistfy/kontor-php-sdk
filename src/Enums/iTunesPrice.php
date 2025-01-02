<?php

namespace Artistfy\Kontor\Enums;

use Exception;

enum iTunesPrice: string
{
    case DIGITAL_45 = 'Digital 45';
    case MINI_EP = 'Mini EP';
    case EP = 'EP';
    case MINI_ALBUM_ONE = 'Mini Album One';
    case MINI_ALBUM_TWO = 'Mini Album Two';
    case BUDGET_ONE = 'Budget One';
    case BUDGET_TWO = 'Budget Two';
    case BACK = 'Back';
    case MID = 'Mid';
    case MID_FRONT = 'Mid/Front';
    case FRONT_ONE = 'Front One';
    case FRONT_TWO = 'Front Two';
    case FRONT_PLUS = 'Front Plus';
    case DELUXE_ONE = 'Deluxe One';
    case DELUXE_TWO = 'Deluxe Two';
    case DELUXE_THREE = 'Deluxe Three';
    case DELUXE_FOUR = 'Deluxe Four';

    public static function fromInt(int $price): self
    {
        return match ($price) {
            129 => self::DIGITAL_45,
            199 => self::MINI_EP,
            299 => self::EP,
            399 => self::MINI_ALBUM_ONE,
            499 => self::BUDGET_ONE,
            599 => self::BUDGET_TWO,
            699 => self::BACK,
            799 => self::MID,
            899 => self::MID_FRONT,
            999 => self::FRONT_ONE,
            1099 => self::FRONT_TWO,
            1199 => self::FRONT_PLUS,
            1299 => self::DELUXE_ONE,
            1399 => self::DELUXE_TWO,
            1499 => self::DELUXE_THREE,
            1599 => self::DELUXE_FOUR,
            default => throw new Exception('No price found for ' . $price),
        };
    }

    public static function toInt(string $case): int
    {
        $price = self::from($case);

        return match ($price) {
            self::DIGITAL_45 => 129,
            self::MINI_EP => 199,
            self::EP => 299,
            self::MINI_ALBUM_ONE => 399,
            self::MINI_ALBUM_TWO, self::BUDGET_ONE => 499,
            self::BUDGET_TWO => 599,
            self::BACK => 699,
            self::MID => 799,
            self::MID_FRONT => 899,
            self::FRONT_ONE => 999,
            self::FRONT_TWO => 1099,
            self::FRONT_PLUS => 1199,
            self::DELUXE_ONE => 1299,
            self::DELUXE_TWO => 1399,
            self::DELUXE_THREE => 1499,
            self::DELUXE_FOUR => 1599,
        };
    }

    public static function fromName(string $name): self
    {
        return collect(self::cases())
            ->first(fn(self $enum) => str_contains($name, $enum->value))
            ?? throw new Exception("Unknown iTunes price [{$name}]");
    }
}
