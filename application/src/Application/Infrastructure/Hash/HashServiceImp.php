<?php

declare(strict_types=1);

namespace App\Application\Infrastructure\Hash;

use App\Application\Domain\Hash\Enum\Algorithm;
use App\Application\Domain\Hash\Service\HashService;

class HashServiceImp implements HashService
{
    public function hash(Algorithm $algorithm, string $input): string
    {
        return hash($algorithm->value, $input);
    }
}
