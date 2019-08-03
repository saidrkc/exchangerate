<?php

declare(strict_types = 1);

namespace App\Module\Domain;

use App\Module\Domain\Exception\RateMustBeInteger;

final class Rate
{
    private $rate;

    public function __construct($rate)
    {
        if (!is_int($rate)) {
            throw new RateMustBeInteger('Rate Value is invalid');
        }
        $this->rate = $rate;
    }

    public function value()
    {
        return $this->rate;
    }
}
