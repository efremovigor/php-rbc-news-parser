<?php


namespace App\Service\Rbc\RbcApiNews;


use App\Service\Rbc\RbcConst;
use Kluatr\DynamicServices\Components\Http\HttpConst;
use Kluatr\DynamicServices\Components\RPC\AbstractHttpDestination;

class RbcApiNewsDestination extends AbstractHttpDestination
{

    public function __construct()
    {
        parent::__construct();
        $this->setMethod(HttpConst::METHOD_GET);
        $this->setTransport(HttpConst::SCHEME_SSL);
        $this->setHost(RbcConst::DOMAIN);

    }

    public function setHostByRequest(RbcApiNewsRequest $request): void
    {
        $this->setRequestUrl(HttpConst::SCHEME_HTTPS.'://'.sprintf(RbcConst::API_NEWS_PATTERN,$request->getTime(),$request->getCount()));
    }
}