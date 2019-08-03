<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Bus\CommandBus;
use App\Module\Application\UpdateExchangeRateCommand;
use App\Module\Application\UpdateExchangeRateCommandHandler;
use App\Module\Domain\Exception\CurrencyEmpty;
use App\Module\Domain\Exception\CurrencyNotAllowed;
use App\Module\Domain\Exception\RateMustBeInteger;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ExchangeRatePatchController
{
    private $commandBus;
    private $commandHandler;
    private const MAPPED_EXCEPTION = [
        RateMustBeInteger::class  => 400,
        CurrencyEmpty::class      => 400,
        CurrencyNotAllowed::class => 400,
    ];

    public function __construct(CommandBus $commandBus, UpdateExchangeRateCommandHandler $commandHandler)
    {
        $this->commandBus       = $commandBus;
        $this->commandHandler = $commandHandler;
    }

    public function update(Request $request): JsonResponse
    {
        $command = new UpdateExchangeRateCommand($request->get('currency'), (int)$request->get('rate'));
        try {
            $this->commandBus->handle($command, $this->commandHandler);
        } catch (Exception $e) {
            return new JsonResponse(['Error ' . $e->getMessage()], $this->mappedException($e));
        }

        return new JsonResponse([], 204);
    }

    private function mappedException(Exception $e): int
    {
        foreach (self::MAPPED_EXCEPTION as $myException => $statusCode) {
            if ($e instanceof $myException) {
                return $statusCode;
            }
        }

        return 500;
    }
}
