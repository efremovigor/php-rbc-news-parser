<?php


namespace App\Service\Rbc\RbcApiNews;


use Kluatr\DynamicServices\Components\RPC\ResponseInterface;
use Kluatr\Serializer\PropertyStrictAccessInterface;
use Kluatr\Serializer\Serializer;

class RbcApiNewsResponse implements PropertyStrictAccessInterface, ResponseInterface
{
    /**
     * @var RbcApiNewsResponseItems
     */
    protected $items;

    /**
     * @inheritDoc
     */
    public function getPropertiesStrict(): array
    {
        return [
            'items' => ['type' => Serializer::TYPE_OBJECT]
        ];
    }

    public function __construct()
    {
        $this->items = new RbcApiNewsResponseItems();
    }

    /**
     * @return RbcApiNewsResponseItems
     */
    public function getItems(): RbcApiNewsResponseItems
    {
        return $this->items;
    }

    /**
     * @param RbcApiNewsResponseItems $items
     */
    public function setItems(RbcApiNewsResponseItems $items): void
    {
        $this->items = $items;
    }

    public function isSuccess(): bool
    {
        return $this->items->count() > 0;
    }

    public function isErrorResponse(): bool
    {
        return false;
    }
}