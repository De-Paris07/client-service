<?php

declare(strict_types=1);

namespace App\Command;

use ClientEventBundle\Query\QueryClientInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CronCommand extends Command
{
    protected static $defaultName = 'app:cron';

    private QueryClientInterface $client;

    /**
     * DispatcherCommand constructor.
     *
     * @param QueryClientInterface $client
     */
    public function __construct(QueryClientInterface $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->client->query('ping', []);

        echo "Made a request cron task 'ping', received an answer - '$response'" . PHP_EOL;

        return self::SUCCESS;
    }
}
