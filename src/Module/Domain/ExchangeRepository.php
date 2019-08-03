<?php

declare(strict_types = 1);

namespace App\Module\Domain;

interface ExchangeRepository
{
    public function update(ExchangeRate $exchangeRate);
    public function all(): array;
}
