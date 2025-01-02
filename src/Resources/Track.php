<?php

namespace Artistfy\Kontor\Resources;

use Illuminate\Support\Arr;

class Track
{
    public function __construct(
        public int $trackId,
        public ?int $discNo,
        public ?int $trackNo,
        public string $url,
        public string $isrc,
        public string $title,
        public ?string $version,
        public string $artistName,
        public array $contributors,
        public ?string $previewUrl,
        public ?array $genres,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'track_id'),
            Arr::get($data, 'disc_no'),
            Arr::get($data, 'track_no'),
            Arr::get($data, 'href'),
            Arr::get($data, 'ext_ids.isrc'),
            Arr::get($data, 'title'),
            Arr::get($data, 'title_version'),
            Arr::get($data, 'artist_name'),
            Arr::get($data, 'contributors'),
            Arr::get($data, 'preview_url'),
            Arr::get($data, 'genres'),
        );
    }
}
