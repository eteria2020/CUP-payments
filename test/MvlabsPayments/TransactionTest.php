<?php

namespace MvlabsPayments;

use MvlabsPayments\Contract\Contract;
use MvlabsPayments\Values\Amount;

use Ramsey\Uuid\Uuid;

class TransactionTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $contract = new Contract();
        $customer = new Customer($contract);
        $customerContract = new CustomerContract($customer);

        $amount = new Amount(123, 'EUR');

        $this->transaction = new Transaction($customerContract, $amount, true);
    }

    public function testId()
    {
        $this->assertInstanceOf(Uuid::class, $this->transaction->id());
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
