<?php

namespace MvlabsPayments\Payments;

use MvlabsPayments\PaymentRequest\PaymentRequest;

interface PaymentInterface
{
    /**
     * Process a payment request
     *
     * @param PaymentRequest $request
     */
    public function pay(PaymentRequest $request);
}
