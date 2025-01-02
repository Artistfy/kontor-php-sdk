<?php

namespace Artistfy\Kontor\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class AlbumTakedownRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected string $albumId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/albums/'.$this->albumId.'/takedown';
    }
}
