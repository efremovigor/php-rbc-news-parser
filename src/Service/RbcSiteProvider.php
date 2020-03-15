<?php

namespace App\Service;

use App\Service\Rbc\RbcApiNews\RbcApiNewsRequest;
use App\Service\Rbc\RbcApiNews\RbcApiNewsResponse;
use App\Service\Rbc\RbcConst;
use App\Service\Rbc\RbcProcesses;
use Kluatr\DynamicServices\CircuitBreakerService;
use Kluatr\DynamicServices\Components\DynamicService\ServiceInfo;
use Kluatr\DynamicServices\Components\Http\HttpResponse;
use Kluatr\DynamicServices\Components\RPC\AbstractRPCProcess;
use Kluatr\DynamicServices\Components\RPC\AbstractRPCService;
use Kluatr\DynamicServices\Components\RPC\RPCRuntimeError;

class RbcSiteProvider extends AbstractRPCService
{
    /**
     * @var SiteRawProvider
     */
    private $siteRawProvider;
    /**
     * @var RbcProcesses
     */
    private $processes;

    public function __construct(CircuitBreakerService $circuitBreakerService, SiteRawProvider $siteRawProvider, RbcProcesses $processes)
    {
        parent::__construct($circuitBreakerService);
        $this->siteRawProvider = $siteRawProvider;
        $this->processes = $processes;
    }

    public function getDomMainPage(): HttpResponse
    {
        return $this->siteRawProvider->get(RbcConst::DOMAIN);
    }

    public function getNewsFromApi(RbcApiNewsRequest $request): RbcApiNewsResponse
    {
        $process = $this->processes->getApiNewsProcess();
        $process->setRequest($request);
        return $this->safeCall($process)->getResponse()->getBody();
    }

    /**
     * @inheritDoc
     */
    protected function throwError(AbstractRPCProcess $process, ServiceInfo $info)
    {
        throw new RPCRuntimeError();
    }
}