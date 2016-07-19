<?php

namespace MvlabsPayments;

use MvlabsPayments\Contract\Contract;

class CustomerContractTest extends \PHPUnit_Framework_TestCase
{
    public function testConstuct()
    {
        $contract = new Contract(1);
        $customer = new Customer(10, $contract);

        $customerContract = new CustomerContract($customer);

        $this->assertSame($customer, $customerContract->customer());
        $this->assertSame($contract, $customerContract->contract());
    }
}
