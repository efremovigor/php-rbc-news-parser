<?php

namespace App\Core;

use App\Repository\RbcNewsRepository;
use App\Repository\RbcStorage;
use App\Service\MailLogger;
use App\Service\NewsService;
use App\Service\Rbc\RbcDependencySupplier;
use App\Service\Rbc\RbcProcesses;
use App\Service\RbcService;
use App\Service\RbcSiteProvider;
use App\Service\SiteRawProvider;
use Kluatr\DI\AbstractDependencySupplier;
use Kluatr\DynamicServices\CircuitBreakerService;
use Kluatr\DynamicServices\Components\DynamicService\BaseDynamicConfigService;
use Kluatr\DynamicServices\Components\DynamicService\DynamicServiceMapper;
use Kluatr\DynamicServices\Components\DynamicService\ServiceInfoSaver;
use Kluatr\DynamicServices\Components\Logger\CircuitBreakerNotifier;
use Kluatr\DynamicServices\HttpService;
use Kluatr\DynamicServices\ServiceInfoFileManager;
use Kluatr\Serializer\Serializer;

class DependencySupplier extends AbstractDependencySupplier
{
    public function __construct()
    {
        parent::__construct();
        $this->initBase();
    }

    private function initBase()
    {
        $this->getRelationList()->addService(ContainerRegistry::class);
        $this->getRelationList()->addService(Serializer::class);
        $this->getRelationList()->addService(BaseDynamicConfigService::class);
        $this->getRelationList()->addService(DynamicServiceMapper::class, [BaseDynamicConfigService::class]);
        $this->getRelationList()->addService(CircuitBreakerService::class, [ServiceInfoSaver::class, DynamicServiceMapper::class, CircuitBreakerNotifier::class, Serializer::class]);
        $this->getRelationList()->addService(ServiceInfoFileManager::class);
        $this->getRelationList()->addService(RbcService::class, [RbcSiteProvider::class, Serializer::class]);
        $this->getRelationList()->addService(ServiceInfoSaver::class, [ServiceInfoFileManager::class]);
        $this->getRelationList()->addService(CircuitBreakerNotifier::class, [MailLogger::class, Serializer::class]);
        $this->getRelationList()->addService(MailLogger::class);
        $this->getRelationList()->addService(HttpService::class, [Serializer::class, MailLogger::class]);
        $this->getRelationList()->addService(SiteRawProvider::class, [CircuitBreakerService::class, HttpService::class, Serializer::class]);
        $this->getRelationList()->addService(RbcProcesses::class, [RbcDependencySupplier::class]);
        $this->getRelationList()->addService(RbcDependencySupplier::class, [HttpService::class, Serializer::class]);
        $this->getRelationList()->addService(RbcSiteProvider::class, [CircuitBreakerService::class, SiteRawProvider::class, RbcProcesses::class]);
        $this->getRelationList()->addService(RbcService::class, [RbcSiteProvider::class, Serializer::class]);
        $this->getRelationList()->addService(NewsService::class, [RbcService::class, RbcNewsRepository::class]);
        $this->getRelationList()->addService(RbcStorage::class);
        $this->getRelationList()->addService(RbcNewsRepository::class, [RbcStorage::class]);

    }
}