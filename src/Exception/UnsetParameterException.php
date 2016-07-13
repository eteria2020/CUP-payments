<?php

namespace MvlabsPayments\Exception;

class UnsetParameterException extends \UnexpectedValueException
{
    public function __construct($name)
    {
        $this->message = sprintf('The parameter %s is not set', $name);
    }
}
