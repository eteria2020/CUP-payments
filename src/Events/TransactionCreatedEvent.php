<?php

namespace MvlabsPayments\Events;

use MvlabsPayments\PaymentRequest\PaymentRequest;
use MvlabsPayments\Transaction;

use Zend\EventManager\Event;

class TransactionCreatedEvent extends Event
{
    public function __construct($target, Transaction $transaction, PaymentRequest $paymentRequest)
    {
        $params = [
            'transaction' => $transaction,
            'paymentRequest' => $paymentRequest
        ];

        parent::__construct('transactionCreated', $target, $params);
    }
}
