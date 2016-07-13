<?php

namespace MvlabsPayments\Payments;

use MvlabsPayments\PaymentRequest\ConcretePaymentRequest;

use Mockery as M;

class PaymentTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->firstPayment = M::mock(FirstPayment::class);
        $this->tokenPayment = M::mock(TokenPayment::class);

        $this->payment = new Payment($this->firstPayment, $this->tokenPayment);
    }

    public function testFirstPayment()
    {
        $paymentRequest = new ConcretePaymentRequest(true);

        $this->firstPayment->shouldReceive('pay')->with($paymentRequest);
    }

    public function testRecurringPayment()
    {
        $paymentRequest = new ConcretePaymentRequest(false);

        $this->tokenPayment->shouldReceive('pay')->with($paymentRequest);
    }
}
