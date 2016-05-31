<?php

namespace Payments\Payments;

use Payments\PaymentRequest\PaymentRequest;
use Payments\Contract\ContractFactory;

class FirstPayment implements PaymentInterface
{
    /**
     * @inheritdoc
     */
    public function pay(PaymentRequest $request)
    {
        $contract = ContractFactory::create();

        $transaction = new Transaction($contract, $request->amount(), true);
    }
}
