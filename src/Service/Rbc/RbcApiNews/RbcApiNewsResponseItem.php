<?php


namespace App\Service\Rbc\RbcApiNews;


use Kluatr\Serializer\PropertyStrictAccessInterface;
use Kluatr\Serializer\Serializer;

class RbcApiNewsResponseItem implements PropertyStrictAccessInterface
{
    /**
     * @var int
     */
    protected $publishDateT;

    /**
     * @var string
     */
    protected $html;
    /**
     * @inheritDoc
     */
    public function getPropertiesStrict(): array
    {
        return [
            'publish_date_t' => ['type' => Serializer::TYPE_INT | Serializer::TYPE_NULL],
            'html'           => ['type' => Serializer::TYPE_STRING | Serializer::TYPE_NULL],
        ];
    }

    /**
     * @return int
     */
    public function getPublishDateT(): int
    {
        return $this->publishDateT;
    }

    /**
     * @param int $publishDateT
     */
    public function setPublishDateT(int $publishDateT): void
    {
        $this->publishDateT = $publishDateT;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param string $html
     */
    public function setHtml(string $html): void
    {
        $this->html = $html;
    }
}