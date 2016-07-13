<?php

namespace MvlabsPayments\Events;

use MvlabsPayments\Customer;
use MvlabsPayments\Contract\Contract;
use MvlabsPayments\CustomerContract;
use MvlabsPayments\Values\Amount;
use MvlabsPayments\Transaction;

class TransactionCreatedEventTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $contract = new Contract();
        $customer = new Customer($contract);
        $customerContract = new CustomerContract($customer);

        $amount = new Amount(123, 'EUR');

        $this->transaction = new Transaction($customerContract, $amount, true);

        $this->event = new TransactionCreatedEvent($this, $this->transaction);
    }

    public function testName()
    {
        $this->assertSame('transactionCreated', $this->event->getName());
    }

    public function testTarget()
    {
        $this->assertSame($this, $this->event->getTarget());
    }

    public function testParameters()
    {
        $parameters = [
            'transaction' => $this->transaction
        ];

        $this->assertSame($parameters, $this->event->getParams());
    }
}
