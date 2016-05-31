<?php

namespace Payments\Exception;

class MalformedAmountException extends \InvalidArgumentException
{
    public function __construct($cents, $currency)
    {
        $this->message = sprintf(
            "It is not possible to construct an amount of %d cents with currency %s",
            $cents,
            $amount
        );
    }
}
