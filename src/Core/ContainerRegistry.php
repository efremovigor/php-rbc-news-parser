<?php

namespace App\Core;

use Kluatr\DI\AbstractRegistry;
use Kluatr\DI\DependencySupplierInterface;

final class ContainerRegistry extends AbstractRegistry
{
    public function __construct(?DependencySupplierInterface $dependencySupplier = null)
    {
        parent::__construct($dependencySupplier);
        /**
         * так как не создавал точку входа, решил оставить это здесь
         * нужно для варианта парсинга главной страницы
         */
        libxml_use_internal_errors(true);
    }
}