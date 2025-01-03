<?php

namespace Artistfy\Kontor\Requests;

use Artistfy\Kontor\Resources\Album;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class SearchAlbumRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * Determines if the request expects a single album to be returned.
     */
    private bool $expectsSole = false;

    public function __construct(
        private bool $includeSubClients = false,
        private ?string $fullTextSearch = null,
        private ?string $title = null,
        private ?string $artistName = null,
        private ?string $productCode = null,
        private ?string $grid = null,
        private ?int $coverSize = null,
        private ?int $offset = null,
        private ?int $limit = null,
    ) {}

    /**
     * If true, the request will expect a single album to be returned.
     */
    public function sole(bool $expectsSole = true): self
    {
        $this->expectsSole = $expectsSole;

        return $this;
    }

    public function resolveEndpoint(): string
    {
        return '/albums/search';
    }

    public function defaultQuery(): array
    {
        return [
            'sub_clients' => $this->includeSubClients,
            'search' => $this->fullTextSearch,
            'title' => $this->title,
            'artist_name' => $this->artistName,
            'product_code' => $this->productCode,
            'grid' => $this->grid,
            'cover_size' => $this->coverSize,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ];
    }

    public function createDtoFromResponse(Response $response): array|Album
    {
        if ($this->expectsSole && $response->json('total') !== 1) {
            throw new \Exception('Expected 1 album, got ' . $response->json('total'));
        }

        if ($this->expectsSole) {
            return Album::fromArray($response->json('items.0'));
        }

        return array_map(function (array $data) {
            return Album::fromArray($data);
        }, $response->json());
    }
}
