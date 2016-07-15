<?php

namespace MvlabsPayments\Contract;

class Contract implements ContractInterface
{
    /**
     * @var integer $id
     */
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function id()
    {
        return $this->id;
    }
}
