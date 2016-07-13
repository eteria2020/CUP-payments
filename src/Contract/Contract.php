<?php

namespace MvlabsPayments\Contract;

use Ramsey\Uuid\Uuid;

class Contract implements ContractInterface
{
    /**
     * @var Uuid $id
     */
    private $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * @return Uuid
     */
    public function id()
    {
        return $this->id;
    }
}
