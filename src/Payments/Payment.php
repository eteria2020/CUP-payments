<?php

namespace MvlabsPayments\Payments;

use MvlabsPayments\PaymentRequest\PaymentRequest;

class Payment implements CompletePaymentInterface
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


    public function completePayment()
    {
        $this->firstPayment->completePayment();
    }
}
