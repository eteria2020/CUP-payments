<?php

namespace MvlabsPayments\Payments;

use MvlabsPayments\Parameters;
use MvlabsPayments\PaymentRequest\ConcretePaymentRequest;
use MvlabsPayments\Events\TransactionCreatedEvent;
use MvlabsPayments\Events\TransactionCompletedEvent;
use MvlabsPayments\Events\TransactionFailedEvent;

use Mockery as M;
use Zend\EventManager\EventManagerInterface;
use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class TokenPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->eventManager = M::mock(EventManagerInterface::class);
        $this->gateway = M::mock(GatewayInterface::class);
        $parameters = new Parameters([
            'alias' => 'batman',
            'cardReference' => 'mycard',
            'card' => '1234567890123456',
            'requestType' => 'recurringPyament'
        ]);

        $this->tokenPayment = new TokenPayment(
            $this->eventManager,
            $this->gateway,
            $parameters
        );
    }

    public function testPay()
    {
        $paymentRequest = new ConcretePaymentRequest(false);

        $this->eventManager->shouldReceive('trigger')->once()->with(
            M::on(
                function ($event) {
                    return $event instanceof TransactionCreatedEvent;
                }
            )
        );
        $this->eventManager->shouldReceive('trigger')->once()->with(
            M::on(
                function ($event) {
                    return $event instanceof TransactionCompletedEvent;
                }
            )
        );

        $response = M::mock(ResponseInterface::class);
        $response->shouldReceive('isSuccessful')->andReturn(true);

        $request = M::mock(RequestInterface::class);
        $request->shouldReceive('send')->andReturn($response);

        $this->gateway->shouldReceive('purchase')->andReturn($request);

        $this->tokenPayment->pay($paymentRequest);
    }

    public function testFailedPay()
    {
        $paymentRequest = new ConcretePaymentRequest(false);

        $this->eventManager->shouldReceive('trigger')->once()->with(
            M::on(
                function ($event) {
                    return $event instanceof TransactionCreatedEvent;
                }
            )
        );
        $this->eventManager->shouldReceive('trigger')->once()->with(
            M::on(
                function ($event) {
                    return $event instanceof TransactionFailedEvent;
                }
            )
        );

        $response = M::mock(ResponseInterface::class);
        $response->shouldReceive('isSuccessful')->andReturn(false);

        $request = M::mock(RequestInterface::class);
        $request->shouldReceive('send')->andReturn($response);

        $this->gateway->shouldReceive('purchase')->andReturn($request);

        $this->tokenPayment->pay($paymentRequest);
    }
}
