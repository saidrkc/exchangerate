<?php

declare(strict_types = 1);

use App\Module\Domain\Currency;
use App\Module\Domain\Exception\RateExchangeCollectionTypeNotAllowed;
use App\Module\Domain\ExchangeRate;
use App\Module\Domain\Rate;
use App\Module\Domain\RateExchangeCollection;
use PHPUnit\Framework\TestCase;

final class RateExchangeCollectionTest extends TestCase
{
    /**
     * @test
     * @expectedException
     */
    public function it_should_throw_rate_exchange_collection_not_allowed()
    {
        $this->expectException(RateExchangeCollectionTypeNotAllowed::class);
        $rateExchangeCollection = new RateExchangeCollection(
            [new Stdclass()]
        );
    }

    /**
     * @test
     */
    public function it_should_create_rate_exchange_collection()
    {
        $rateExchangeCollection = new RateExchangeCollection(
            [new ExchangeRate(new Currency('EUR'), new Rate(2))]
        );

        $this->assertInstanceOf(RateExchangeCollection::class, $rateExchangeCollection);
        $this->assertNotEmpty($rateExchangeCollection);
    }
}
