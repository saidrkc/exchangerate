<?php

declare(strict_types = 1);

namespace App\Bus;

final class QueryBus
{
    public function ask(Query $query, Handler $queryHandler)
    {
        return $queryHandler->__invoke($query);
    }
}
