<?php

namespace Artistfy\Kontor\Resources;

use Artistfy\Kontor\Enums\iTunesPrice;
use Artistfy\Kontor\Enums\Price;
use Artistfy\Kontor\Enums\ProductType;
use Artistfy\Kontor\Helper;
use DateTimeInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Album
{
    public function __construct(
        public int $albumId,
        public string $url,
        public string $label,
        public ProductType $type,
        public ?string $ean,
        public ?string $upc,
        public string $title,
        public ?string $version,
        public string $artistName,
        public array $contributors,
        public ?DateTimeInterface $preorderStart,
        public ?DateTimeInterface $salesStart,
        public ?DateTimeInterface $salesEnd,
        public bool $prelistenAudio,
        public bool $prelistenWhilePreorder,
        public Price $priceCode,
        public iTunesPrice $itunesPrice,
        public array $genres,
        public string $coverUrl,
        public int $discCount,
        public Collection $tracks,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'album_id'),
            Arr::get($data, 'href'),
            Arr::get($data, 'label.name'),
            ProductType::fromName(Arr::get($data, 'album_type_name')),
            Arr::get($data, 'ext_ids.ean'),
            Arr::get($data, 'ext_ids.upc'),
            Arr::get($data, 'title'),
            Arr::get($data, 'title_version'),
            Arr::get($data, 'artist_name'),
            Arr::get($data, 'contributors'),
            Helper::mapToDateIfNotNull(Arr::get($data, 'preorder_start')),
            Helper::mapToDateIfNotNull(Arr::get($data, 'sales_start')),
            Helper::mapToDateIfNotNull(Arr::get($data, 'sales_end')),
            Arr::get($data, 'prelisten_audio'),
            Arr::get($data, 'prelisten_while_preorder'),
            Price::fromCode(Arr::get($data, 'price_code.code')),
            iTunesPrice::fromName(Arr::get($data, 'price_code_itunes.name')),
            Arr::get($data, 'genres'),
            Arr::get($data, 'cover.url'),
            Arr::get($data, 'tracks.disc_count'),
            collect(Arr::get($data, 'tracks.items'))
                ->map(fn(array $track) => Track::fromArray($track)),
        );
    }

    public function identifier(): string
    {
        return $this->ean ?? $this->upc ?? '';
    }
}
