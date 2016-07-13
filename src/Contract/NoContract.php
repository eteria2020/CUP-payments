<?php

namespace MvlabsPayments\Contract;

class NoContract implements ContractInterface
{
    public function id()
    {
        return null;
    }
}
