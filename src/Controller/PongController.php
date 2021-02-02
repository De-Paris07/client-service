<?php

declare(strict_types=1);

namespace App\Controller;

use ClientEventBundle\Annotation\QueueRoute;
use ClientEventBundle\Query\QueryRequest;
use ClientEventBundle\Query\QueryResponse;

class PongController
{
    /**
     * @QueueRoute(name="ping", description="ping-pong route")
     *
     * @param QueryRequest $request
     *
     * @return QueryResponse
     */
    public function pond(QueryRequest $request): QueryResponse
    {
        return new QueryResponse(['pong']);
    }
}
