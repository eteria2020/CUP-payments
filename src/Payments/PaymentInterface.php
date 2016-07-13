<?php

namespace Payments\Payments;

use Payments\PaymentRequest\PaymentRequest;

interface PaymentInterface
{
    /**
     * Process a payment request
     *
     * @param PaymentRequest $request
     */
    public function pay(PaymentRequest $request);
}
