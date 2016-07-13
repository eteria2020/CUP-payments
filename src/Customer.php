<?php

namespace MvlabsPayments;

use MvlabsPayments\Contract\ContractInterface;
use MvlabsPayments\Contract\NoContract;

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

    /**
     * @return ContractInterface
     */
    public function contract()
    {
        return $this->contract;
    }

    /**
     * @return CustomerContract
     */
    public function customerContract()
    {
        return new CustomerContract($this, $this->contract);
    }
}
