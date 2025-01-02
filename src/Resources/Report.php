<?php

namespace Artistfy\Kontor\Resources;

use Artistfy\Kontor\Helper;
use DateTimeInterface;
use Illuminate\Support\Arr;

class Report
{
    public function __construct(
        public int $reportId,
        public string $documentNo,
        public DateTimeInterface $documentDate,
        public string $period,
        public DateTimeInterface $startDate,
        public DateTimeInterface $endDate,
        public string $currency,
        public float $proceeds,
        public float $royalties,
        public float $advancePayment,
        public float $payoutNet,
        public float $payoutVat,
        public ?float $payoutVatRate,
        public float $payoutWithholdingTax,
        public float $payoutSurplusTax,
        public float $payoutGross,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'report_id'),
            Arr::get($data, 'document_no'),
            Helper::toDate(Arr::get($data, 'document_date')),
            Arr::get($data, 'period'),
            Helper::toDate(Arr::get($data, 'start_date')),
            Helper::toDate(Arr::get($data, 'end_date')),
            Arr::get($data, 'currency'),
            Arr::get($data, 'proceeds'),
            Arr::get($data, 'royalties'),
            Arr::get($data, 'advance_payment'),
            Arr::get($data, 'payout_net'),
            Arr::get($data, 'payout_vat'),
            Arr::get($data, 'payout_vat_rate'),
            Arr::get($data, 'payout_withholding_tax'),
            Arr::get($data, 'payout_surplus_tax'),
            Arr::get($data, 'payout_gross'),
        );
    }
}
