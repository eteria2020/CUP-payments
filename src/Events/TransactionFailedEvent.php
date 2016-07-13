<?php

namespace MvlabsPayments\Events;

use MvlabsPayments\Transaction;

use Zend\EventManager\Event;

class TransactionFailedEvent extends Event
{
    public function __construct($target, Transaction $transaction)
    {
        $params = [
            'transaction' => $transaction
        ];

        parent::__construct('transactionFailed', $target, $params);
    }
}
