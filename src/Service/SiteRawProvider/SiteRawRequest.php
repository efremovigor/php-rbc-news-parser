<?php


namespace App\Service\SiteRawProvider;


use Kluatr\DynamicServices\Components\RPC\RequestInterface;

class SiteRawRequest implements RequestInterface
{

    /**
     * Мок так как в этом случае нет реквеста
     * @return bool
     */
    public function isValid(): bool
    {
        return true;
    }
}