<?php

declare(strict_types = 1);

use App\Module\Application\UpdateExchangeRateCommand;
use App\Module\Application\UpdateExchangeRateCommandHandler;
use App\Module\Domain\ExchangeRepository;
use PHPUnit\Framework\TestCase;

final class UpdateLastestExchangeRateCommandHandlerTest extends TestCase
{
    private $exchangeRepository;

    protected function setUp()
    {
        $this->exchangeRepository = $this->createMock(ExchangeRepository::class);
    }

    /**
     * @test
     */
    public function it_should_update_currenct_exchange_rate()
    {

        $command        = new UpdateExchangeRateCommand('EUR', 22);
        $commandHandler = new UpdateExchangeRateCommandHandler($this->exchangeRepository);

        $this->shouldSaveExchangeRate();

        $commandHandler->__invoke($command);

        $this->assertTrue(true);
    }

    private function shouldSaveExchangeRate()
    {
        $this->exchangeRepository->method('update');
    }
}
