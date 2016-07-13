<?php

namespace MvlabsPayments\Contract;

use Ramsey\Uuid\Uuid;

class ContractTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->contract = new Contract();
    }

    public function testInstanceOfContractInterface()
    {
        $this->assertInstanceOf(ContractInterface::class, $this->contract);
    }

    public function testId()
    {
        $this->assertInstanceOf(Uuid::class, $this->contract->id());
    }
}
