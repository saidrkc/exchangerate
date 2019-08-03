<?php

declare(strict_types = 1);

namespace App\Module\Application;

use App\Bus\Handler;
use App\Module\Domain\Currency;
use App\Module\Domain\ExchangeRate;
use App\Module\Domain\ExchangeRepository;
use App\Module\Domain\Rate;
use App\Module\Domain\RateExchangeCollection;

final class CheckLastestExchangeRateQueryHandler implements Handler
{
    private $exchangeRepository;

    public function __construct(ExchangeRepository $exchangeRepository)
    {
        $this->exchangeRepository = $exchangeRepository;
    }

    public function __invoke(CheckLastestExchangeRateQuery $query): RateExchangeCollection
    {
        $redisResponse = $this->exchangeRepository->all();

        return new RateExchangeCollection(
            [new ExchangeRate(new Currency($redisResponse['currency']), new Rate($redisResponse['rate']))]
        );
    }
}