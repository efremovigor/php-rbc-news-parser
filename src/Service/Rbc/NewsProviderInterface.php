<?php


namespace App\Service\Rbc;


interface NewsProviderInterface
{
    public function getTopNews(int $count): RbcNewsList;
}