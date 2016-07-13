<?php

namespace MvlabsPayments\Values;

use MvlabsPayments\Exception\MalformedAmountException;

class Amount
{
    /**
     * @var int $cents
     */
    private $cents;

    /**
     * Three letter code defining the currency
     *
     * @var string $currency
     */
    private $currency;

    public function __construct($cents, $currency)
    {
        if (!is_int($cents) || !is_string($currency) || strlen($currency) != 3) {
            throw new MalformedAmountException($cents, $currency);
        }

        $this->cents = $cents;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function cents()
    {
        return $this->cents;
    }

    /**
     * @return string
     */
    public function format()
    {
        return number_format($this->cents/100, 2, '.', '');
    }

    /**
     * @return string
     */
    public function currency()
    {
        return $this->currency;
    }
}
