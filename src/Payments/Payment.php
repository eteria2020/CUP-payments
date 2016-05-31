<?php

namespace Payments\Payments;

use Payments\PaymentRequest\PaymentRequest;

class Payment implements PaymentInterface
{
    /**
     * @var FirstPayment $firstPayment
     */
    private $firstPayment;

    /**
     * @var TokenPayment $tokenPayment
     */
    private $tokenPayment;

    public function __construct(
        FirstPayment $firstPayment,
        TokenPayment $tokenPayment
    ) {
        $this->firstPayment;
        $this->tokenPayment;
    }

    /**
     * @inheritdoc
     */
    public function pay(PaymentRequest $request)
    {
        if ($request->isFirstPayment()) {
            $this->firstPayment->pay($request);
        } else {
            $this->tokenPayment->pay($request);
        }
    }
}
