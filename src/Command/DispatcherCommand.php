<?php

declare(strict_types=1);

namespace App\Command;

use App\Event\TestEvent;
use ClientEventBundle\Dispatcher\QueueEventDispatcherInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DispatcherCommand extends Command
{
    protected static $defaultName = 'app:dispatcher';

    private QueueEventDispatcherInterface $dispatcher;

    /**
     * DispatcherCommand constructor.
     *
     * @param QueueEventDispatcherInterface $dispatcher
     */
    public function __construct(QueueEventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $event = new TestEvent();
        $event->setField('field');
        $this->dispatcher->dispatch($event->getEventName(), $event);

        echo 'Sent the event synchronously' . PHP_EOL;

        return self::SUCCESS;
    }
}
