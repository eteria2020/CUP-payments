<?php

namespace MvlabsPayments\Contract;

class ContractTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->contract = new Contract(1, '201511');
    }

    public function testInstanceOfContractInterface()
    {
        $this->assertInstanceOf(ContractInterface::class, $this->contract);
    }

    public function testId()
    {
        $this->assertSame(1, $this->contract->id());
    }

    public function testExpiryDate()
    {
        $this->assertSame('201511', $this->contract->expiryDate());
    }
}
