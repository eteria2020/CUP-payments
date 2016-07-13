<?php

namespace Payments\Exception;

class MalformedAmountExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testMessage()
    {
        $cents = 123;
        $currency = 'EUR';

        $exception = new MalformedAmountException($cents, $currency);

        $this->assertSame(
            sprintf(
                "It is not possible to construct an amount of %d cents with currency %s",
                $cents,
                $currency
            ),
            $exception->getMessage()
        );
    }
}
