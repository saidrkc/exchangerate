<?php

declare(strict_types = 1);

use App\Module\Domain\Exception\RateMustBeInteger;
use App\Module\Domain\Rate;
use PHPUnit\Framework\TestCase;

final class RateTest extends TestCase
{
    /**
     * @test
     * @expectedException
     */
    public function it_should_throw_rate_must_be_integer_exception()
    {
        $this->expectException(RateMustBeInteger::class);
        $rate = new Rate(2.0);
    }

    /**
     * @test
     */
    public function it_should_create_correct_rate()
    {
        $rate = new Rate(200);

        $this->assertInstanceOf(Rate::class, $rate);
    }
}
