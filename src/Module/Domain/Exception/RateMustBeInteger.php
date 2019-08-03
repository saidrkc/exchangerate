<?php

declare(strict_types = 1);

namespace App\Module\Domain\Exception;

use Symfony\Component\Config\Definition\Exception\Exception;

final class RateMustBeInteger extends Exception
{
}
