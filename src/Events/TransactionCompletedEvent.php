<?php

namespace MvlabsPayments\Events;

use MvlabsPayments\Transaction;

use Zend\EventManager\Event;

class TransactionCompletedEvent extends Event
{
    public function __construct($target, Transaction $transaction)
    {
        $params = [
            'transaction' => $transaction
        ];

        parent::__construct('transactionCompleted', $target, $params);
    }
}
