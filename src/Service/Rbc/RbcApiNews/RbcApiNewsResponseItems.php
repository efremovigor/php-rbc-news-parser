<?php


namespace App\Service\Rbc\RbcApiNews;

use Kluatr\Serializer\Components\EntityList;

class RbcApiNewsResponseItems extends EntityList
{
    public function getClass(): string
    {
        return RbcApiNewsResponseItem::class;
    }


    /**
     * @return RbcApiNewsResponseItem[]
     */
    public function getElements(): array
    {
        return parent::getElements();
    }
}