<?php

namespace App\Service;

use App\Service\SiteRawProvider\SiteRawDestination;
use App\Service\SiteRawProvider\SiteRawProcess;
use Kluatr\DynamicServices\CircuitBreakerService;
use Kluatr\DynamicServices\Components\DynamicService\ServiceInfo;
use Kluatr\DynamicServices\Components\Http\HttpResponse;
use Kluatr\DynamicServices\Components\Http\HttpServiceInterface;
use Kluatr\DynamicServices\Components\RPC\AbstractRPCProcess;
use Kluatr\DynamicServices\Components\RPC\AbstractRPCService;
use Kluatr\DynamicServices\Components\RPC\RPCRuntimeError;
use Kluatr\Serializer\SerializerInterface;

class SiteRawProvider extends AbstractRPCService
{

    /**
     * @var HttpServiceInterface
     */
    private $httpService;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(CircuitBreakerService $circuitBreakerService, HttpServiceInterface $httpService, SerializerInterface $serializer)
    {
        parent::__construct($circuitBreakerService);
        $this->httpService = $httpService;
        $this->serializer = $serializer;
    }

    /**
     * @param string $host
     * @return HttpResponse
     */
    public function get(string $host): HttpResponse
    {
        return $this->safeCall($this->getNewProcess($host))->getResponse();
    }

    /**
     * Библиотека не расчитана на то чтобы делать запросы на динамические хосты, поэтому без этого пока невозможно обойтись
     * @param string $host
     * @return SiteRawProcess
     */
    private function getNewProcess(string $host): SiteRawProcess
    {
        return new SiteRawProcess($this->httpService,$this->serializer,new SiteRawDestination($host));
    }

    /**
     * @param AbstractRPCProcess $process
     * @param ServiceInfo $info
     * @return mixed
     * @throws RPCRuntimeError
     */
    protected function throwError(AbstractRPCProcess $process, ServiceInfo $info)
    {
        throw new RPCRuntimeError();
    }
}