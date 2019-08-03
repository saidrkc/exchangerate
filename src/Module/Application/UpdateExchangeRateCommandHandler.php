<?php

declare(strict_types = 1);

namespace App\Module\Application;

use App\Bus\Handler;
use App\Module\Domain\Currency;
use App\Module\Domain\ExchangeRate;
use App\Module\Domain\ExchangeRepository;
use App\Module\Domain\Rate;
use Exception;

final class UpdateExchangeRateCommandHandler implements Handler
{
    private $exchangeRateRepository;

    public function __construct(ExchangeRepository $exchangeRepository) {
        $this->exchangeRateRepository = $exchangeRepository;
    }

    public function __invoke(UpdateExchangeRateCommand $command)
    {
        try {
            $this->exchangeRateRepository->update(
                new ExchangeRate(new Currency($command->currency()), new Rate($command->rate()))
            );
        } catch (Exception $e){
            throw $e;
        }
    }
}
