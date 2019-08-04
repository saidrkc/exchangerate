<?php

declare(strict_types = 1);

use App\Module\Application\CheckLastestExchangeRateQuery;
use App\Module\Application\CheckLastestExchangeRateQueryHandler;
use App\Module\Domain\Exception\CurrencyNotAllowed;
use App\Module\Domain\Exception\RateMustBeInteger;
use App\Module\Domain\ExchangeRepository;
use App\Module\Domain\RateExchangeCollection;
use PHPUnit\Framework\TestCase;

final class CheckLastestExchangeRateQueryHandlerTest extends TestCase
{
    private $exchangeRepository;

    protected function setUp()
    {
        $this->exchangeRepository = $this->createMock(ExchangeRepository::class);
    }

    /**
     * @test
     */
    public function it_should_return_all_exchange_rates()
    {

        $query        = new CheckLastestExchangeRateQuery();
        $queryHandler = new CheckLastestExchangeRateQueryHandler($this->exchangeRepository);

        $this->shouldReturnRepositoryResponse($this->exchangeResponse());

        $rates = $queryHandler->__invoke($query);

        $this->assertInstanceOf(RateExchangeCollection::class, $rates);
    }

    /**
     * @test
     */
    public function it_should_throw_currency_not_allowed_exception()
    {

        $this->expectException(CurrencyNotAllowed::class);
        $query        = new CheckLastestExchangeRateQuery();
        $queryHandler = new CheckLastestExchangeRateQueryHandler($this->exchangeRepository);

        $this->shouldReturnRepositoryResponse($this->exchangeResponseIncorrectCurrency());

        $rates = $queryHandler->__invoke($query);
    }

    /**
     * @test
     */
    public function it_should_throw_rate_must_be_integer_exception()
    {

        $this->expectException(RateMustBeInteger::class);
        $query        = new CheckLastestExchangeRateQuery();
        $queryHandler = new CheckLastestExchangeRateQueryHandler($this->exchangeRepository);

        $this->shouldReturnRepositoryResponse($this->exchangeResponseIncorrectRate());

        $rates = $queryHandler->__invoke($query);
    }

    private function shouldReturnRepositoryResponse($response)
    {
        $this->exchangeRepository->method('all')->willReturn($response);
    }

    private function exchangeResponse(): array
    {
        return ['currency' => 'EUR', 'rate' => 10];
    }

    private function exchangeResponseIncorrectCurrency(): array
    {
        return ['currency' => 'FR', 'rate' => 10];
    }

    private function exchangeResponseIncorrectRate(): array
    {
        return ['currency' => 'EUR', 'rate' => 2.0];
    }
}
