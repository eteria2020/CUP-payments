<?php

namespace Payments;

use Payments\Exception\UnsetParameterException;

class Parameters
{
    /**
     * @var array $parameters
     */
    private $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function __get($name)
    {
        if (!isset($this->parameters[$name])) {
            throw new UnsetParameterException($name);
        }

        return $this->parameters[$name];
    }
}
