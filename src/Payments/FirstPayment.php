<?php

namespace MvlabsPayments\Payments;

use MvlabsPayments\PaymentRequest\PaymentRequest;
use MvlabsPayments\CustomerContract;
use MvlabsPayments\Events\ContractCreatedEvent;
use MvlabsPayments\Events\TransactionCreatedEvent;
use MvlabsPayments\Events\FirstTransactionCompletedEvent;
use MvlabsPayments\Customer;
use MvlabsPayments\Parameters;
use MvlabsPayments\Transaction;
use MvlabsPayments\Values\Amount;

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

        $transaction = $this->createTransaction($request, $customerContract);

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
        $this->eventManager->trigger($contractCreatedEvent);

        return $customer->customerContract();
    }

    private function createTransaction(PaymentRequest $request, CustomerContract $customerContract)
    {
        $transaction = new Transaction($customerContract, $request->amount(), true);

        $transactionCreatedEvent = new TransactionCreatedEvent($this, $transaction, $request);
        $this->eventManager->trigger($transactionCreatedEvent);

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
        $this->eventManager->trigger($firstTransactionCompletedEvent);
    }
}
