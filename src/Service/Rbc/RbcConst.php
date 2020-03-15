<?php


namespace App\Service\Rbc;


interface RbcConst
{
    public const DOMAIN = 'www.rbc.ru';
    public const API_NEWS_PATTERN = self::DOMAIN . '/v10/ajax/get-news-feed/project/rbcnews.spb_sz/lastDate/%d/limit/%d';
}