<?php

namespace Test\Unit;

use App\Core\ContainerRegistry;
use App\Core\DependencySupplier;
use App\Repository\RbcStorage;
use App\Service\NewsService;
use App\Service\RbcService;
use PHPUnit\Framework\TestCase;

class RbkTest extends TestCase
{
    public function testRbkRequest()
    {
        $container = new ContainerRegistry(new DependencySupplier());

        /**
         * @var $provider RbcService
         */
        $provider = $container->get(RbcService::class);

        $this->assertTrue($provider instanceof RbcService);

        $list = $provider->getTopNews(15);
        $this->assertEquals($list->count(), 15);
    }

    public function testSaveNews()
    {
        $container = new ContainerRegistry(new DependencySupplier());
        /**
         * @var $provider NewsService
         */
        $provider = $container->get(NewsService::class);

        /**
         * @var $storage RbcStorage
         */
        $storage = $container->get(RbcStorage::class);

        $storage->rewrite('rbknews.csv', '');


        $provider->saveLatestNews();

        $data = $storage->get();

        $this->assertTrue(!empty($data));
        $array = explode("\r\n", $data);
        $this->assertEquals(count($array), 16);
        $this->assertEquals($array[15], '');

        for ($i = 0, $c = 15; $i < $c; $i++) {
            $arrayItem = explode("|||", $array[$i]);
            $this->assertEquals(count($arrayItem), 3);
        }

    }
}