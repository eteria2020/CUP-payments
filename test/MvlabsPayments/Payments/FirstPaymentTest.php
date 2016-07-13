<?php

namespace MvlabsPayments\Payments;

use MvlabsPayments\Parameters;
use MvlabsPayments\PaymentRequest\ConcretePaymentRequest;
use MvlabsPayments\Events\ContractCreatedEvent;
use MvlabsPayments\Events\TransactionCreatedEvent;
use MvlabsPayments\Events\FirstTransactionCompletedEvent;

use Mockery as M;
use Zend\EventManager\EventManagerInterface;
use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class FirstPaymentTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->eventManager = M::mock(EventManagerInterface::class);
        $this->gateway = M::mock(GatewayInterface::class);
        $parameters = new Parameters([
            'alias' => 'batman',
            'returnUrl' => 'http://example.com/return/url',
            'cancelUrl' => 'http://example.com/cancel/url',
            'macKey' => 'ajfgarefaldfkjanliue560254i'
        ]);

        $this->firstPayment = new FirstPayment(
            $this->eventManager,
            $this->gateway,
            $parameters
        );
    }

    public function testPay()
    {
        $paymentRequest = new ConcretePaymentRequest(true);

        $this->eventManager->shouldReceive('trigger')->once()->with(
            M::on(
                function ($event) {
                    return $event instanceof ContractCreatedEvent;
                }
            )
        );
        $this->eventManager->shouldReceive('trigger')->once()->with(
            M::on(
                function ($event) {
                    return $event instanceof TransactionCreatedEvent;
                }
            )
        );

        $response = M::mock(ResponseInterface::class);
        $response->shouldReceive('redirect');

        $request = M::mock(RequestInterface::class);
        $request->shouldReceive('send')->andReturn($response);

        $this->gateway->shouldReceive('purchase')->andReturn($request);

        $this->firstPayment->pay($paymentRequest);
    }

    public function testCompletePayment()
    {
        $this->eventManager->shouldReceive('trigger')->once()->with(
            M::on(
                function ($event) {
                    return $event instanceof FirstTransactionCompletedEvent;
                }
            )
        );

        $response = M::mock(ResponseInterface::class);
        $response->shouldReceive('getTransactionId');
        $response->shouldReceive('getContractId');
        $response->shouldReceive('getAmount');
        $response->shouldReceive('getCurrency');

        $request = M::mock(RequestInterface::class);
        $request->shouldReceive('send')->andReturn($response);

        $this->gateway->shouldReceive('completePurchase')->andReturn($request);

        $this->firstPayment->completePayment();
    }
}
