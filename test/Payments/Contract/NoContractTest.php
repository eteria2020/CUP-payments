<?php

namespace Payments\Contract;

class NoContractTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->contract = new NoContract();
    }

    public function testInstanceOfContractInterface()
    {
        $this->assertInstanceOf(ContractInterface::class, $this->contract);
    }

    public function testId()
    {
        $this->assertNull($this->contract->id());
    }
}
