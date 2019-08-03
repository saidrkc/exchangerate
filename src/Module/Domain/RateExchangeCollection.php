<?php

declare(strict_types = 1);

namespace App\Module\Domain;

use App\Module\Domain\Exception\RateExchangeCollectionTypeNotAllowed;

final class RateExchangeCollection
{
    private $exchangeRates;

    public function __construct(array $exchangeRates)
    {
        $this->guard($exchangeRates);
        $this->exchangeRates = $exchangeRates;
    }

    private function guard(array $exchangeRates)
    {
        foreach ($exchangeRates as $instanceRate) {
            if (false === ($instanceRate instanceof ExchangeRate)) {
                throw new RateExchangeCollectionTypeNotAllowed('Collection type not allowed');
            }
        }
    }

    public function exchangeRates() {
        return $this->exchangeRates;
    }
}
