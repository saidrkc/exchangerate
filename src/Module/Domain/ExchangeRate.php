<?php

declare(strict_types = 1);

namespace App\Module\Domain;

final class ExchangeRate
{
    private $currency;
    private $rate;

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function rate(): Rate
    {
        return $this->rate;
    }

    public function __construct(Currency $currency, Rate $rate)
    {
        $this->currency = $currency;
        $this->rate     = $rate;
    }
}
