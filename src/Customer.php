<?php

namespace Payments;

class Customer
{
    /**
     * @param Contract
     */
    private $contract;

    public function __construct(
        ContractInterface $contract
    ) {
        $this->contract = $contract;
    }

    /**
     * @return bool
     */
    public function hasContract()
    {
        return !($this->contract instanceof NoContract);
    }
}
