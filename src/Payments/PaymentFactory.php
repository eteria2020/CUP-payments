<?php

namespace Payments\Payments;

use Payments\PaymentRequest\PaymentRequest;

class PaymentFactory
{
    public static function choosePayment(PaymentRequest $request)
    {
        if ($request->isFirstPayment()) {
            return new FirstPayment();
        }

        return new TokenPayment();
    }
}
