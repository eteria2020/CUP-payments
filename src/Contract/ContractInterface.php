<?php

namespace Payments\Contract;

use Payments\Customer;

interface ContractInterface
{
    /**
     * @return int
     */
    public function id();

    /**
     * @return Customer
     */
    //public function customer();
}
