<?php


namespace App\Repository;


use App\Service\Rbc\RbcNewsList;

class RbcNewsRepository
{
    private const DELIMITER = '|||';

    /**
     * @var StorageInterface
     */
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function save(RbcNewsList $list)
    {
        $string = '';

        foreach ($list->getElements() as $element) {
            $string .= $element->getId().static::DELIMITER . $element->getTitle() . static::DELIMITER . $element->getUrl()."\r\n";
        }
        $this->storage->save($string);
    }
}