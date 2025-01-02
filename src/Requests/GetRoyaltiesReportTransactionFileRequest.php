<?php

namespace Artistfy\Kontor\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRoyaltiesReportTransactionFileRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private string $reportId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/royalties/reports/'.$this->reportId.'/transactions.zip';
    }
}
