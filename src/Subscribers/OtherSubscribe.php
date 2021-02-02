<?php

declare(strict_types=1);

namespace App\Subscribers;

use App\Event\OtherEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OtherSubscribe implements EventSubscriberInterface
{
    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
          'other' => 'onOther'
        ];
    }

    public function onOther(OtherEvent $event)
    {
        echo "Completed eventName - {$event->getEventName()} " . PHP_EOL;
    }
}
