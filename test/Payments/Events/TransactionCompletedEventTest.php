<?php

namespace Payments\Events;

use Payments\Customer;
use Payments\Contract\Contract;
use Payments\CustomerContract;
use Payments\Values\Amount;
use Payments\Transaction;

class TransactionCompletedEventTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $contract = new Contract();
        $customer = new Customer($contract);
        $customerContract = new CustomerContract($customer);

        $amount = new Amount(123, 'EUR');

        $this->transaction = new Transaction($customerContract, $amount, true);

        $this->event = new TransactionCompletedEvent($this, $this->transaction);
    }

    public function testName()
    {
        $this->assertSame('transactionCompleted', $this->event->getName());
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
