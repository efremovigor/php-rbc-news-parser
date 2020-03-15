<?php


namespace App\Service\Rbc\RbcApiNews;


use Kluatr\DynamicServices\Components\Http\HttpServiceInterface;
use Kluatr\DynamicServices\Components\RPC\AbstractHttpProcess;
use Kluatr\DynamicServices\Components\RPC\RequestInterface;
use Kluatr\Serializer\SerializerInterface;

class RbcApiNewsProcess extends AbstractHttpProcess
{

    public function __construct(HttpServiceInterface $httpService, SerializerInterface $serializer, RbcApiNewsDestination $destination)
    {
        parent::__construct($httpService, $serializer);
        $this->destination = $destination;
    }

    public function execute(): void
    {
        $this->destination->setHostByRequest($this->getRequest());
        parent::execute();
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return RbcApiNewsResponse::class;
    }

    /**
     * @return RequestInterface|RbcApiNewsRequest
     */
    public function getRequest(): RequestInterface
    {
        return parent::getRequest();
    }
}