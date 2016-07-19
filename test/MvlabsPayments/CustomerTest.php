<?php

namespace MvlabsPayments;

use MvlabsPayments\Contract\Contract;
use MvlabsPayments\Contract\NoContract;
use MvlabsPayments\CustomerContract;

class CustomerTets extends \PHPUnit_Framework_TestCase
{
    public function testHasContract()
    {
        $contract = new Contract(1);
        $customer = new Customer(10, $contract);

        $this->assertTrue($customer->hasContract());
    }

    public function testDoesNotHaveContract()
    {
        $contract = new NoContract();
        $customer = new Customer(10, $contract);

        $this->assertFalse($customer->hasContract());
    }

    public function testCustomerContract()
    {
        $contract = new Contract(1);
        $customer = new Customer(10, $contract);

        $this->assertInstanceOf(CustomerContract::class, $customer->customerContract());
    }
}
