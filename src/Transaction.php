<?php

namespace Payments;

use Payments\CustomerContract;
use Payments\Values\Amount;

use Ramsey\Uuid\Uuid;

class Transaction
{
    /**
     * @var Uuid $id
     */
    private $id;

    /**
     * @var CustomerContract $contract
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
        CustomerContract $contract,
        Amount $amount,
        $isFirstPayment
    ) {
        $this->id = Uuid::uuid4();
        $this->contract = $contract;
        $this->amount = $amount;
        $this->isFirstPayment = $isFirstPayment;
    }

    /**
     * @return Uuid
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function formattedAmount()
    {
        return $this->amount->format();
    }

    /**
     * @return string
     */
    public function currency()
    {
        return $this->amount->currency();
    }

    /**
     * @return bool
     */
    public function isFirstPayment()
    {
        return $this->isFirstPayment;
    }
}
