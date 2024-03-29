<?php

namespace MvlabsPayments;

use MvlabsPayments\Customer;
use MvlabsPayments\Contract\Contract;

class CustomerContract
{
    /**
     * @var Customer $customer
     */
    private $customer;

    /**
     * @var Contract $contract
     */
    private $contract;

    public function __construct(
        Customer $customer
    ) {
        $this->customer = $customer;
        $this->contract = $customer->contract();
    }

    public function customer()
    {
        return $this->customer;
    }

    public function contract()
    {
        return $this->contract;
    }
}
