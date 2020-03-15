<?php

namespace App\Service\SiteRawProvider;


use Kluatr\DynamicServices\Components\Http\HttpServiceInterface;
use Kluatr\DynamicServices\Components\RPC\AbstractHttpProcess;
use Kluatr\Serializer\SerializerInterface;

class SiteRawProcess extends AbstractHttpProcess
{

    public function __construct(HttpServiceInterface $httpService, SerializerInterface $serializer, SiteRawDestination $destination)
    {
        parent::__construct($httpService, $serializer);
        $this->destination = $destination;
        $this->request = new SiteRawRequest();
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return SiteRawResponse::class;
    }

    /**
     * Мок так как в этом случае нет реквеста
     * @return string
     */
    public function getBody(): string
    {
        return '';
    }
}