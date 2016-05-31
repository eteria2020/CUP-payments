<?php

namespace Payments\Payments;

use Payments\PaymentRequest\PaymentRequest;

interface PaymentInterface
{
    /**
     * Process a payment request
     *
     * @param PaymentRequest $request
     * @return PaymentOutcome
     */
    public function pay(PaymentRequest $request);
}
