<?php

namespace MvlabsPayments;

use MvlabsPayments\CustomerContract;
use MvlabsPayments\Values\Amount;

class Transaction
{
    /**
     * @var $id
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
    private $isFirstPayment;

    public function __construct(
        CustomerContract $contract,
        Amount $amount,
        $isFirstPayment
    ) {
        $this->contract = $contract;
        $this->amount = $amount;
        $this->isFirstPayment = $isFirstPayment;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
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
     * @return int
     */
    public function getAmountCents()
    {
        return $this->amount->cents();
    }

    /**
     * @return string
     */
    public function getAmountCurrency()
    {
        return $this->amount->currency();
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
