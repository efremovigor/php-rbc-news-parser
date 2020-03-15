<?php


namespace App\Service\Rbc\RbcApiNews;


use Kluatr\DynamicServices\Components\RPC\RequestInterface;
use Kluatr\Serializer\PropertyStrictAccessInterface;

/**
 * Мок так как у нас пустой реквест
 * Библиотека писалась для обмена данными, поэтому не было учтено что реквест может быть пустым
 * Class RbcApiNewsRequest
 * @package App\Service\Rbc\RbcApiNews
 */
class RbcApiNewsRequest implements RequestInterface,PropertyStrictAccessInterface
{

    /**
     * @var int
     */
    private $time;
    /**
     * @var int
     */
    private $count;

    public function __construct(int $time, int $count)
    {
        $this->time = $time;
        $this->count = $count;
    }

    public function isValid(): bool
    {
        return true;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @inheritDoc
     */
    public function getPropertiesStrict(): array
    {
        return [];
    }
}