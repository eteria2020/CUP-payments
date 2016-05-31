<?php

namespace Payments\Payments;

use Payments\PaymentRequest\PaymentRequest;

class TokenPayment implements PaymentInterface
{
    /**
     * @inheritdoc
     */
    public function pay(PaymentRequest $request)
    {
        $transaction = new Transaction($contract, $request->amount(), true);
    }
}
