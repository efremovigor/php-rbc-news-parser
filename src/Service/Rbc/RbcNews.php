<?php

namespace App\Service\Rbc;


use Kluatr\Serializer\PropertyStrictAccessInterface;
use Kluatr\Serializer\Serializer;

class RbcNews implements PropertyStrictAccessInterface
{

    /**
     * @var string|null
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $title;

    /**
     * @var string|null
     */
    protected $url;


    /**
     * @inheritDoc
     */
    public function getPropertiesStrict(): array
    {
        return [
            'id'    => ['type' => Serializer::TYPE_STRING | Serializer::TYPE_NULL],
            'title' => ['type' => Serializer::TYPE_STRING | Serializer::TYPE_NULL],
            'url'   => ['type' => Serializer::TYPE_STRING | Serializer::TYPE_NULL],
        ];
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}