<?php

namespace Payments\Payments;

use Payments\PaymentRequest\PaymentRequest;
use Payments\CustomerContract;
use Payments\Events\ContractCreatedEvent;
use Payments\Events\TransactionCreatedEvent;
use Payments\Events\FirstTransactionCompletedEvent;
use Payments\Customer;
use Payments\Parameters;
use Payments\Transaction;
use Payments\Values\Amount;

use Zend\EventManager\EventManagerInterface;
use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Message\ResponseInterface;

class FirstPayment implements CompletePaymentInterface
{
    /**
     * @var EventManagerInterface $eventManager
     */
    private $eventManager;

    /**
     * @var GatewayInterface $gateway
     */
    private $gateway;

    /**
     * @var Parameters
     */
    private $parameters;

    public function __construct(
        EventManagerInterface $eventManager,
        GatewayInterface $gateway,
        Parameters $parameters
    ) {
        $this->eventManager = $eventManager;
        $this->gateway = $gateway;
        $this->parameters = $parameters;
    }

    /**
     * @inheritdoc
     */
    public function pay(PaymentRequest $request)
    {
        $customerContract = $this->createCustomerContract($request->customer());

        $transaction = $this->createTransaction($request->amount(), $customerContract);

        $parameters = [
            'alias' => $this->parameters->alias,
            'amount' => $transaction->formattedAmount(),
            'currency' => $transaction->currency(),
            'transactionId' => $transaction->id(),
            'returnUrl' => $this->parameters->returnUrl,
            'cancelUrl' => $this->parameters->cancelUrl,
            'messageAuthenticationCodeKey' => $this->parameters->macKey
        ];

        $response = $this->gateway->purchase($parameters)->send();

        $response->redirect();
    }

    /**
     * @param Customer $customer
     * @return CustomerContract
     */
    private function createCustomerContract(Customer $customer)
    {
        $contractCreatedEvent = new ContractCreatedEvent($this, $customer->customerContract());
        $this->eventManager->triggerEvent($contractCreatedEvent);

        return $customer->customerContract();
    }

    private function createTransaction(Amount $amount, CustomerContract $customerContract)
    {
        $transaction = new Transaction($customerContract, $amount, true);

        $transactionCreatedEvent = new TransactionCreatedEvent($this, $transaction);
        $this->eventManager->triggerEvent($transactionCreatedEvent);

        return $transaction;
    }


    public function completePayment()
    {
        $response = $this->gateway->completePurchase([
            'messageAuthenticationCodeKey' => $this->parameters->macKey
        ])->send();

        $this->completedTransaction($response);
    }

    private function completedTransaction(ResponseInterface $response)
    {
        $firstTransactionCompletedEvent = new FirstTransactionCompletedEvent($this, $response);
        $this->eventManager->triggerEvent($firstTransactionCompletedEvent);
    }
}
