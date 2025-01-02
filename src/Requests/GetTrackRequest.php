<?php

namespace Artistfy\Kontor\Requests;

use Artistfy\Kontor\Resources\Track;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetTrackRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $trackId,
        protected bool $includePreviews = false,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tracks/'.$this->trackId;
    }

    public function defaultQuery(): array
    {
        return [
            'fields' => $this->includePreviews ? ['preview_url'] : null,
        ];
    }

    public function createDtoFromResponse(Response $response): Track
    {
        return Track::fromArray($response->json());
    }
}
