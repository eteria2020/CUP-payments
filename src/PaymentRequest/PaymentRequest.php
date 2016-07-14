<?php

namespace MvlabsPayments\PaymentRequest;

use MvlabsPayments\Customer;
use MvlabsPayments\Values\Amount;

interface PaymentRequest
{
    /**
     * @return Customer
     */
    public function customer();

    /**
     * @return Amount
     */
    public function amount();

    /**
     * @return bool
     */
    public function isFirstPayment();
}
