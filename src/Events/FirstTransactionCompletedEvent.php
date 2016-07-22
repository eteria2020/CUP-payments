<?php

namespace MvlabsPayments\Events;

use Zend\EventManager\Event;
use Omnipay\Common\Message\ResponseInterface;

class FirstTransactionCompletedEvent extends Event
{
    public function __construct($target, ResponseInterface $response)
    {
        $params = [
            'transactionId' => $response->getTransactionId(),
            'contractId' => $response->getContractId(),
            'amount' => $response->getAmount(),
            'currency' => $response->getCurrency(),
            'cardExpiryDate' => $response->getCardExpiryDate()
        ];

        parent::__construct('firstTransactionCompleted', $target, $params);
    }
}
