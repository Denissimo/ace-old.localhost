<?php

namespace App\Service\System;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;

/**
 * Выключаем добавление беcполезной команды в down миграции
 */
class MigrationEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            'postGenerateSchema',
        );
    }

    public function postGenerateSchema(GenerateSchemaEventArgs $Args)
    {
        $Schema = $Args->getSchema();

        if (! $Schema->hasNamespace('public')) {
            $Schema->createNamespace('public');
        }
    }
}