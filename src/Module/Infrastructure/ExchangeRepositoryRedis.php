<?php

declare(strict_types = 1);

namespace App\Module\Infrastructure;

use App\Module\Domain\ExchangeRate;
use App\Module\Domain\ExchangeRepository;

final class ExchangeRepositoryRedis implements ExchangeRepository
{
    public function update(ExchangeRate $exchangeRate)
    {
        return;
    }

    public function all(): array
    {
        return ['currency' => "eur", "rate" => 12];
    }
}
