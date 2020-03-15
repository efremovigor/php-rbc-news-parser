<?php


namespace App\Service;


use App\Repository\RbcNewsRepository;
use App\Service\Rbc\NewsProviderInterface;

class NewsService
{
    /**
     * @var NewsProviderInterface
     */
    private $provider;
    /**
     * @var RbcNewsRepository
     */
    private $repository;

    public function __construct(NewsProviderInterface $provider, RbcNewsRepository $repository)
    {
        $this->provider = $provider;
        $this->repository = $repository;
    }

    public function saveLatestNews(){
        $list = $this->provider->getTopNews(15);
        $this->repository->save($list);
    }
}