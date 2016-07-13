<?php

namespace Payments\Events;

use Payments\CustomerContract;

use Zend\EventManager\Event;

class ContractCreatedEvent extends Event
{
    public function __construct($target, CustomerContract $customerContract)
    {
        $params = [
            'customerContract' => $customerContract
        ];

        parent::__construct('contractCreated', $target, $params);
    }
}
