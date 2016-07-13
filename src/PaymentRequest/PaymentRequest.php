<?php

namespace MvlabsPayments\PaymentRequest;

use MvlabsPayments\Customer;
use MvlabsPayments\Value\Amount;

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
