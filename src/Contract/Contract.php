<?php

namespace Payments\Contract;

use Payments\Customer;

class Contract implements ContractInterface
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var Customer $customer
     */
    //private $customer;

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return Customer
     */
    /*public function customer()
    {
        return $this->customer;
    }*/
}
