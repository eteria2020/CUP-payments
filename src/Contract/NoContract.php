<?php

namespace Payments\Contract;

class NoContract implements ContractInterface
{
    public function id()
    {
        return null;
    }
}
