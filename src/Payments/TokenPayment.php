<?php

namespace MvlabsPayments\Payments;

use MvlabsPayments\PaymentRequest\PaymentRequest;
use MvlabsPayments\Parameters;
use MvlabsPayments\CustomerContract;
use MvlabsPayments\Transaction;
use MvlabsPayments\Values\Amount;
use MvlabsPayments\Events\TransactionCreatedEvent;
use MvlabsPayments\Events\TransactionCompletedEvent;
use MvlabsPayments\Events\TransactionFailedEvent;

use Zend\EventManager\EventManagerInterface;
use Omnipay\Common\GatewayInterface;

class TokenPayment implements PaymentInterface
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
        $customer = $request->customer();

        $transaction = $this->createTransaction($request, $customer->customerContract());

        $parameters = [
            'alias' => $this->parameters->alias,
            'amount' => $transaction->formattedAmount(),
            'currency' => $transaction->currency(),
            'transactionId' => $transaction->id(),
            'cardReference' => $this->parameters->cardReference,
            'card' => $this->parameters->card,
            'requestType' => $this->parameters->requestType
        ];

        $response = $this->gateway->purchase($parameters)->send();

        if ($response->isSuccessful()) {
            $this->completedTransaction($transaction);
        } else {
            $this->failedTransaction($transaction);
        }
    }

    private function createTransaction(PaymentRequest $request, CustomerContract $customerContract)
    {
        $transaction = new Transaction($customerContract, $request->amount(), true);

        $transactionCreatedEvent = new TransactionCreatedEvent($this, $transaction, $request);
        $this->eventManager->trigger($transactionCreatedEvent);

        return $transaction;
    }

    private function completedTransaction(Transaction $transaction)
    {
        $transactionCompletedEvent = new TransactionCompletedEvent($this, $transaction);
        $this->eventManager->trigger($transactionCompletedEvent);
    }

    private function failedTransaction(Transaction $transaction)
    {
        $transactionFailedEvent = new TransactionFailedEvent($this, $transaction);
        $this->eventManager->trigger($transactionFailedEvent);
    }
}
