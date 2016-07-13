<?php

namespace Payments\Payments;

interface CompletePaymentInterface extends PaymentInterface
{
    public function completePayment();
}
