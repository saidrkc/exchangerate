<?php

declare(strict_types = 1);

namespace App\Bus;

final class CommandBus
{
    public function handle(Command $command, Handler $commandHandler)
    {
        return $commandHandler->__invoke($command);
    }
}
