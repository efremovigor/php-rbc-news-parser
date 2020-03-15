<?php

namespace App\Service;

use App\Helper\DomHelper;
use App\Service\Rbc\NewsProviderInterface;
use App\Service\Rbc\RbcApiNews\RbcApiNewsRequest;
use App\Service\Rbc\RbcNews;
use App\Service\Rbc\RbcNewsList;
use DOMXPath;
use Kluatr\Serializer\SerializerInterface;

class RbcService implements NewsProviderInterface
{
    /**
     * @var RbcSiteProvider
     */
    private $provider;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(RbcSiteProvider $provider, SerializerInterface $serializer)
    {
        $this->provider = $provider;
        $this->serializer = $serializer;
    }


    /**
     * @param int $count
     * @return RbcNewsList
     */
    public function getTopNews(int $count): RbcNewsList
    {
        return $this->getLatestNewsTheWay2($count);
    }

    /**
     * Способ номер 1 - получаем с помощью парсинга главной страницы
     * @param int $count
     * @return RbcNewsList
     */
    private function getLatestNewsTheWay1(int $count = 15): RbcNewsList
    {
        $list = new RbcNewsList();
        $document = DomHelper::getDom($this->provider->getDomMainPage()->getRawBody());


        /**
         * @todo :Не старался причесать особо это место, так как тут всяко все шатко, из-за нестабильности самого способа
         * Если надо могупричесать
         */
        foreach ((new DOMXPath($document))->query("//div[contains(@class,'js-news-feed-list')]//a[contains(@class,'news-feed__item')]") as $key => $item) {
            try {
                //Пытаемся подчистить title
                $item->textContent = explode('  ', trim(preg_replace('/\\n/', '', $item->textContent)))[0];
            } catch (\Throwable $exception) {
                continue;
            }

            $list->add($this->serializer->normalize(['title' => $item->textContent, 'url' => $item->getAttribute('href')], RbcNews::class));
            if ($list->count() === 15) {
                break;
            }
        }
        return $list;
    }

    /**
     * Способ 2 более стабильный, так как получаем из api rbc
     * @param int $count
     * @return RbcNewsList
     */
    private function getLatestNewsTheWay2(int $count = 15): RbcNewsList
    {
        $list = new RbcNewsList();
        $response = $this->provider->getNewsFromApi(new RbcApiNewsRequest(time(), $count));
        foreach ($response->getItems()->getElements() as $item) {

            try {
                //Пытаемся распарсить данный
                $document = DomHelper::getDom($item->getHtml());

                $title = (new DOMXPath($document))->query("//a[contains(@class,'news-feed__item')]//span[contains(@class,'news-feed__item__title')]")->item(0)->textContent;

                $list->add($this->serializer->normalize(
                    [
                        'id'    => (new DOMXPath($document))->query("//a[contains(@class,'news-feed__item')]")->item(0)->getAttribute('id'),
                        'title' => trim(preg_replace('/\n/', '',$title)),
                        'url'   => (new DOMXPath($document))->query("//a[contains(@class,'news-feed__item')]")->item(0)->getAttribute('href'),
                    ],
                    RbcNews::class));

            } catch (\Throwable $exception) {
                continue;
            }

            if ($list->count() === $count) {
                break;
            }
        }

        return $list;
    }
}