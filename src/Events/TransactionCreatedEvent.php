<?php

namespace MvlabsPayments\Events;

use MvlabsPayments\Transaction;

use Zend\EventManager\Event;

class TransactionCreatedEvent extends Event
{
    public function __construct($target, Transaction $transaction)
    {
        $params = [
            'transaction' => $transaction
        ];

        parent::__construct('transactionCreated', $target, $params);
    }
}
