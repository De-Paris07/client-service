<?php

declare(strict_types=1);

namespace App\Command;

use App\Event\OtherEvent;
use App\Event\TestEvent;
use ClientEventBundle\Dispatcher\QueueEventDispatcherInterface;
use ClientEventBundle\Loop\ClientTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DaemonPeriodicCommand extends Command
{
    use ClientTrait;

    protected static $defaultName = 'app:daemon';

    private QueueEventDispatcherInterface $dispatcher;
    private ContainerInterface $container;

    /**
     * DaemonPeriodicCommand constructor.
     *
     * @param QueueEventDispatcherInterface $dispatcher
     * @param ContainerInterface $container
     */
    public function __construct(QueueEventDispatcherInterface $dispatcher, ContainerInterface $container)
    {
        $this->dispatcher = $dispatcher;
        $this->container = $container;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws \Throwable
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->initClient();

        // интервал выполнения будет по конфигу процесса
        $this->addJob($this->dispatchJob());
        $this->addJob($this->otherJob(), 20);

        try {
            $this->start();
        } catch (\Throwable $throwable) {
            throw $throwable;
        }

        return self::SUCCESS;
    }

    /**
     * @return \Closure
     */
    private function dispatchJob(): \Closure
    {
        return function () {
            $event = new TestEvent();
            $event->setField('field');
            $this->dispatcher->dispatch($event->getEventName(), $event);

            echo 'Asynchronously completed the "dispatchJob" task ' . PHP_EOL;
        };
    }

    /**
     * @return \Closure
     */
    private function otherJob(): \Closure
    {
        return function () {
            $event = new OtherEvent();
            $event->setField('field');
            $this->dispatcher->dispatch($event->getEventName(), $event);

            echo 'Asynchronously completed the "otherJob" task' . PHP_EOL;
        };
    }
}
