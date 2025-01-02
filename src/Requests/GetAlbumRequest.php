<?php

namespace Artistfy\Kontor\Requests;

use Artistfy\Kontor\Resources\Album;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetAlbumRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $albumId,
        protected ?int $coverSize = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/albums/' . $this->albumId;
    }

    public function defaultQuery(): array
    {
        return [
            'cover_size' => $this->coverSize,
        ];
    }

    public function createDtoFromResponse(Response $response): Album
    {
        return Album::fromArray($response->json());
    }
}
