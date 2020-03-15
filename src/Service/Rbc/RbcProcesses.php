<?php

namespace App\Service\Rbc;

use App\Service\Rbc\RbcApiNews\RbcApiNewsProcess;
use Kluatr\DI\AbstractRegistry;

class RbcProcesses extends AbstractRegistry
{

    public function getApiNewsProcess(): RbcApiNewsProcess
    {
        return $this->get(RbcApiNewsProcess::class);
    }
}