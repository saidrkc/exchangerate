<?php

declare(strict_types = 1);

namespace App\Module\Domain;

use App\Module\Domain\Exception\CurrencyEmpty;
use App\Module\Domain\Exception\CurrencyNotAllowed;

final class Currency
{
    private const ALLOWED_CURRENCY = ['EUR', 'USD'];
    private $currency;

    public function __construct(?string $currency)
    {
        $this->guard($currency);
        $this->currency = strtoupper($currency);
    }

    private function guard(?string $currency)
    {
        if (null === $currency) {
            throw new CurrencyEmpty('Empty currency not allowed');
        }
        if (!in_array(strtoupper($currency), self::ALLOWED_CURRENCY)) {
            throw new CurrencyNotAllowed('Not allowed Currency');
        }
    }

    public function value()
    {
        return $this->currency;
    }
}
