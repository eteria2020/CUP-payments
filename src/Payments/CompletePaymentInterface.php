<?php

namespace MvlabsPayments\Payments;

interface CompletePaymentInterface extends PaymentInterface
{
    public function completePayment();
}
