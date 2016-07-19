<?php

namespace MvlabsPayments\Events;

use MvlabsPayments\Customer;
use MvlabsPayments\Contract\Contract;
use MvlabsPayments\CustomerContract;
use MvlabsPayments\PaymentRequest\ConcretePaymentRequest;
use MvlabsPayments\Values\Amount;
use MvlabsPayments\Transaction;

class TransactionCreatedEventTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $contract = new Contract(1);
        $customer = new Customer(10, $contract);
        $customerContract = new CustomerContract($customer);

        $amount = new Amount(123, 'EUR');

        $this->transaction = new Transaction($customerContract, $amount, true);

        $this->request = new ConcretePaymentRequest(true);
        $this->event = new TransactionCreatedEvent($this, $this->transaction, $this->request);
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
            'transaction' => $this->transaction,
            'paymentRequest' => $this->request
        ];

        $this->assertSame($parameters, $this->event->getParams());
    }
}
