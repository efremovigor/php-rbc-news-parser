<?php

namespace App\Service\Rbc;

use App\Service\Rbc\RbcApiNews\RbcApiNewsDestination;
use App\Service\Rbc\RbcApiNews\RbcApiNewsProcess;
use Kluatr\DI\AbstractDependencySupplier;
use Kluatr\DynamicServices\HttpService;
use Kluatr\Serializer\Serializer;

class RbcDependencySupplier extends AbstractDependencySupplier
{
    public function __construct(HttpService $httpService, Serializer $serializer)
    {
        parent::__construct();
        $this->getInitializedList()->add($httpService);
        $this->getInitializedList()->add($serializer);
        $this->getRelationList()->replaceService(RbcApiNewsDestination::class);
        $this->getRelationList()->replaceService(RbcApiNewsProcess::class, [HttpService::class, Serializer::class,RbcApiNewsDestination::class]);
    }
}