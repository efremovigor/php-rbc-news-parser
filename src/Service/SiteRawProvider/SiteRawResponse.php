<?php


namespace App\Service\SiteRawProvider;


use Kluatr\DynamicServices\Components\RPC\ResponseInterface;

/**
 * Мок так как упаковки запроса здесь нет, и нам нужен сырой ответ
 * Class SiteRawResponse
 * @package App\Service\SiteRawProvider
 */
class SiteRawResponse implements ResponseInterface
{

    public function isSuccess(): bool
    {
        return true;
    }

    public function isErrorResponse(): bool
    {
        return false;
    }
}