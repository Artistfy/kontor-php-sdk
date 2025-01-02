<?php

namespace Artistfy\Kontor;

use DateTimeImmutable;

class Helper
{
    public static function mapToDateIfNotNull(?string $date): ?DateTimeImmutable
    {
        return $date ? self::toDate($date) : null;
    }

    public static function toDate(string $date): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat('Y-m-d', $date)
            ?: throw new \InvalidArgumentException('Invalid date format');
    }
}
