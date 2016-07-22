<?php

namespace MvlabsPayments\Contract;

class Contract implements ContractInterface
{
    /**
     * @var integer $id
     */
    private $id;
    /**
     * @var string
     */
    private $expiryDate;

    public function __construct($id, $expiryDate)
    {
        $this->id = $id;
        $this->expiryDate = $expiryDate;
    }

    /**
     * @return integer
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function expiryDate()
    {
        return $this->expiryDate;
    }
}
