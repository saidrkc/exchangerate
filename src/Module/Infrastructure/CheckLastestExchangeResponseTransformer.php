<?php

declare(strict_types = 1);

namespace App\Module\Infrastructure;

use App\Module\Domain\RateExchangeCollection;

final class CheckLastestExchangeResponseTransformer
{
    private $response;

    public function __construct(RateExchangeCollection $response)
    {
        $this->response = $response;
    }

    public function transform()
    {

        foreach ($this->response->exchangeRates() as $exchangeRate) {
            $rates[] = ['Currency' => $exchangeRate->currency()->value(), 'Rate' => $exchangeRate->rate()->value()];
        }

        return [
            'Rates' => $rates,

        ];
    }
}
