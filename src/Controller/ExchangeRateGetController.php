<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Bus\QueryBus;
use App\Module\Application\CheckLastestExchangeRateQuery;
use App\Module\Application\CheckLastestExchangeRateQueryHandler;
use App\Module\Domain\Exception\CurrencyEmpty;
use App\Module\Domain\Exception\CurrencyNotAllowed;
use App\Module\Domain\Exception\RateExchangeCollectionTypeNotAllowed;
use App\Module\Domain\Exception\RateMustBeInteger;
use App\Module\Infrastructure\CheckLastestExchangeResponseTransformer;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ExchangeRateGetController
{
    private $queryBus;
    private $queryHandler;
    private const MAPPED_EXCEPTION = [
        RateExchangeCollectionTypeNotAllowed::class => 412,
        RateMustBeInteger::class                    => 412,
        CurrencyEmpty::class                        => 412,
        CurrencyNotAllowed::class                   => 412,
    ];

    public function __construct(QueryBus $queryBus, CheckLastestExchangeRateQueryHandler $queryHandler)
    {
        $this->queryBus = $queryBus;
        $this->queryHandler = $queryHandler;
    }

    public function all(): JsonResponse
    {
        $query = new CheckLastestExchangeRateQuery();
        try {
            $response = new CheckLastestExchangeResponseTransformer(
                $this->queryBus->ask($query, $this->queryHandler)
            );
        } catch (Exception $e) {
            return new JsonResponse(['Error ' . $e->getMessage()], $this->mappedException($e));
        }

        return new JsonResponse([$response->transform()], 200);
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
