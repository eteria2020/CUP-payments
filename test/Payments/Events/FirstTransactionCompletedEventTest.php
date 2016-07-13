<?php

namespace Payments\Events;

use Mockery as M;
use Omnipay\Common\Message\ResponseInterface;

class FirstTransactionCompletedEventTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->response = M::mock(ResponseInterface::class);
        $this->response->shouldReceive('getTransactionId')->andReturn(123456);
        $this->response->shouldReceive('getContractId')->andReturn(7890);
        $this->response->shouldReceive('getAmount')->andReturn(1234);
        $this->response->shouldReceive('getCurrency')->andReturn('EUR');

        $this->event = new FirstTransactionCompletedEvent($this, $this->response);
    }

    public function testName()
    {
        $this->assertSame('firstTransactionCompleted', $this->event->getName());
    }

    public function testTarget()
    {
        $this->assertSame($this, $this->event->getTarget());
    }

    public function testParameters()
    {
        $parameters = [
            'transactionId' => $this->response->getTransactionId(),
            'contractId' => $this->response->getContractId(),
            'amount' => $this->response->getAmount(),
            'currency' => $this->response->getCurrency()
        ];

        $this->assertSame($parameters, $this->event->getParams());
    }
}
