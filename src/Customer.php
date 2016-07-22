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

    private $id;

    public function __construct(
        $id,
        ContractInterface $contract
    ) {
        $this->contract = $contract;
        $this->id = $id;
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

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    public function setContract(ContractInterface $contract)
    {
        $this->contract = $contract;
    }
}
