<?php

namespace MvlabsPayments;

use MvlabsPayments\Contract\Contract;
use MvlabsPayments\Values\Amount;

class TransactionTest extends \PHPUnit_Framework_TestCase
{
    private $transaction;

    public function setUp()
    {
        $contract = new Contract(1);
        $customer = new Customer(10, $contract);
        $customerContract = new CustomerContract($customer);

        $amount = new Amount(123, 'EUR');

        $this->transaction = new Transaction($customerContract, $amount, true);
        $this->transaction->setId(100);
    }

    public function testId()
    {
        $this->assertSame(100, $this->transaction->id());
    }

    public function testFormattedAmout()
    {
        $this->assertSame('1.23', $this->transaction->formattedAmount());
    }

    public function testCurrency()
    {
        $this->assertSame('EUR', $this->transaction->currency());
    }

    public function testIsFirstPayment()
    {
        $this->assertSame(true, $this->transaction->isFirstPayment());
    }
}
