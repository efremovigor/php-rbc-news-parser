<?php


namespace App\Helper;


class DomHelper
{

    public static function getDom($data): \DOMDocument
    {
        $doc = new \DOMDocument('1.0');
        $doc->loadHTML(mb_convert_encoding($data, 'HTML-ENTITIES', 'UTF-8'));

        return $doc;
    }
}