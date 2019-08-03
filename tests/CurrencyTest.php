<?php

declare(strict_types = 1);

use App\Module\Domain\Currency;
use App\Module\Domain\Exception\CurrencyEmpty;
use App\Module\Domain\Exception\CurrencyNotAllowed;
use PHPUnit\Framework\TestCase;

final class CurrencyTest extends TestCase
{
    /**
     * @test
     * @expectedException
     */
    public function it_should_throw_currency_not_allowed_exception()
    {
        $this->expectException(CurrencyNotAllowed::class);
        $currency = new Currency('TR');
    }

    /**
     * @test
     * @expectedException
     */
    public function it_should_throw_empty_currency_exception()
    {
        $this->expectException(CurrencyEmpty::class);
        $currency = new Currency(null);
    }

    /**
     * @test
     */
    public function it_should_create_correct_currency()
    {
        $currency = new Currency('EUR');

        $this->assertInstanceOf(Currency::class, $currency);
    }
}
