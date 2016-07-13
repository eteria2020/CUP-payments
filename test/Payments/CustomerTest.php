<?php

namespace Payments;

use Payments\Contract\Contract;
use Payments\Contract\NoContract;
use Payments\CustomerContract;

class CustomerTets extends \PHPUnit_Framework_TestCase
{
    public function testHasContract()
    {
        $contract = new Contract();
        $customer = new Customer($contract);

        $this->assertTrue($customer->hasContract());
    }

    public function testDoesNotHaveContract()
    {
        $contract = new NoContract();
        $customer = new Customer($contract);

        $this->assertFalse($customer->hasContract());
    }

    public function testCustomerContract()
    {
        $contract = new Contract();
        $customer = new Customer($contract);

        $this->assertInstanceOf(CustomerContract::class, $customer->customerContract());
    }
}
