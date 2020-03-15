<?php


namespace App\Service\SiteRawProvider;


use Kluatr\DynamicServices\Components\Http\HttpConst;
use Kluatr\DynamicServices\Components\RPC\AbstractHttpDestination;

/**
 * Class SiteRawDestination
 * todo::Библиотека не поддерживает данный кейс, поэтому приходится её натягивать на требования
 * @package App\Service\SiteRawProvider
 */
class SiteRawDestination extends AbstractHttpDestination
{
    public function __construct(string $host)
    {
        parent::__construct();
        $this->setMethod(HttpConst::METHOD_GET);
        $this->setTransport(HttpConst::SCHEME_SSL);
        $this->setHost($host);
        $this->setRequestUrl(HttpConst::SCHEME_HTTPS.'://'.$this->getHost());

    }
}