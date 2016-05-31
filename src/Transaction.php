<?php

namespace Payments;

use Payments\Contract\Contract;

class Transaction
{
    /**
     * @var Contract $contract
     */
    private $contract;

    /**
     * @var Amount $amount
     */
    private $amount;

    /**
     * @var bool $isFirstPayment
     */
    private $isFristPayment;

    public function __construct(
        Contract $contract,
        Amount $amount,
        $isFirstPayment
    ) {
        $this->contract = $contract;
        $this->amount = $amount;
        $this->isFirstPayment = $isFirstPayment;
    }
}
