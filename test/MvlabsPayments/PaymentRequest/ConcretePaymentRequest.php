<?php

namespace MvlabsPayments\PaymentRequest;

use MvlabsPayments\Contract\Contract;
use MvlabsPayments\Customer;
use MvlabsPayments\Values\Amount;

/**
 * Mock ckass to be used in Payment tests
 */
class ConcretePaymentRequest implements PaymentRequest
{
    /**
     * @param bool
     */
    private $isFirstPayment;

    public function __construct($isFirstPayment)
    {
        $this->isFirstPayment = $isFirstPayment;
    }

    public function customer()
    {
        $contract = new Contract(1, '202011');

        return new Customer(10, $contract);
    }

    public function amount()
    {
        return new Amount(123, 'EUR');
    }

    public function isFirstPayment()
    {
        return $this->isFirstPayment;
    }
}
