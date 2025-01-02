<?php

namespace Artistfy\Kontor\Enums;

enum ProductType: string
{
    case ALBUM = 'Album';
    case COMPILATION = 'Compilation';
    case EP = 'EP';
    case SINGLE = 'Single';

    public static function fromName(string $name): self
    {
        return collect(self::cases())
            ->first(fn (self $productType) => str_contains($name, $productType->value))
            ?? throw new \Exception("Unknown product type [{$name}]");
    }
}
