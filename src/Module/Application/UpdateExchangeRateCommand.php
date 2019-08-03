<?php

declare(strict_types = 1);

namespace App\Module\Application;

use App\Bus\Command;

final class UpdateExchangeRateCommand implements Command
{
    private $currency;
    private $rate;

    public function __construct(?string $currency, int $rate)
    {
        $this->currency = $currency;
        $this->rate     = $rate;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function rate(): int
    {
        return $this->rate;
    }
}
