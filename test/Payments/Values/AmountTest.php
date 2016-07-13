<?php

namespace Payments\Values;

class AmountTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectCurrency()
    {
        $amount = new Amount(123, 'EUR');

        $this->assertSame('EUR', $amount->currency());
    }

    public function testWrongCurrency()
    {
        $this->expectException('Payments\Exception\MalformedAmountException');

        $amount = new Amount(213, 'EURI');
    }

    public function testCentsAmount()
    {
        $amount = new Amount(123, 'EUR');

        $this->assertSame(123, $amount->cents());
    }

    public function testFormat()
    {
        $amount = new Amount(123, 'EUR');

        $this->assertSame('1.23', $amount->format());
    }

    public function testCastFormat()
    {
        $amount = new Amount(123, 'EUR');

        $this->assertSame(1.23, (float) $amount->format());
    }
}
