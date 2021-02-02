<?php

declare(strict_types=1);

namespace App\Subscribers;

use App\Event\OtherEvent;
use App\Kernel;
use ClientEventBundle\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Yaml\Yaml;

class QueueEventsSubscribe implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        $config = Yaml::parseFile(
            (new Kernel('prod', false))->getProjectDir()
            . '/config/packages/client_event.yaml'
        );

        return array_fill_keys(
            array_filter(
                array_keys($config['client_event']['events_subscribe']),
                function ($value) use ($config){
                    return ! (new $config['client_event']['events_subscribe'][$value]['target_object']() instanceof OtherEvent);
                }
            ),
            'onHandle'
        );
    }

    public function onHandle(Event $event)
    {
        echo "Completed eventName - {$event->getEventName()} " . PHP_EOL;
    }
}
