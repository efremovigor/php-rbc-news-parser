<?php
namespace App\Service\Rbc;

use Kluatr\Serializer\Components\EntityList;

class RbcNewsList extends EntityList
{
    public function getClass(): string
    {
        return RbcNews::class;
    }

    /**
     * @return RbcNews[]
     */
    public function getElements(): array
    {
        return parent::getElements();
    }
}