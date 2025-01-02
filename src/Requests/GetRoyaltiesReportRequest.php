<?php

namespace Artistfy\Kontor\Requests;

use Artistfy\Kontor\Resources\Report;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetRoyaltiesReportRequest extends Request
{
    /**
     * Define the HTTP method.
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected ?string $clientId = null,
        protected ?int $limit = null,
        protected ?int $startYear = null,
        protected ?int $endYear = null,
    ) {}

    protected function defaultQuery(): array
    {
        return [
            'clientId' => $this->clientId,
            'limit' => $this->limit,
            'startYear' => $this->startYear,
            'endYear' => $this->endYear,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/royalties/reports';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return array_map(
            fn(array $data) => Report::fromArray($data),
            $response->json('reports') ?? []
        );
    }
}
