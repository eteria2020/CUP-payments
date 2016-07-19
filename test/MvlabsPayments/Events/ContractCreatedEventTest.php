<?php

namespace MvlabsPayments\Events;

use MvlabsPayments\Customer;
use MvlabsPayments\Contract\Contract;
use MvlabsPayments\CustomerContract;

class ContractCreatedEventTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $contract = new Contract(1);
        $customer = new Customer(10, $contract);
        $this->customerContract = new CustomerContract($customer);

        $this->event = new ContractCreatedEvent($this, $this->customerContract);
    }

    public function testName()
    {
        $this->assertSame('contractCreated', $this->event->getName());
    }

    public function testTarget()
    {
        $this->assertSame($this, $this->event->getTarget());
    }

    public function testParameters()
    {
        $parameters = [
            'customerContract' => $this->customerContract
        ];

        $this->assertSame($parameters, $this->event->getParams());
    }
}
