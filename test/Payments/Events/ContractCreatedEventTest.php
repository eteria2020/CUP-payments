<?php

namespace Payments\Events;

use Payments\Customer;
use Payments\Contract\Contract;
use Payments\CustomerContract;

class ContractCreatedEventTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $contract = new Contract();
        $customer = new Customer($contract);
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
