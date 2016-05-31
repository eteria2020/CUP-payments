<?php

namespace Payments\Contract;

class ContractFactory
{
    public function create()
    {
        return new Contract();
    }
}
