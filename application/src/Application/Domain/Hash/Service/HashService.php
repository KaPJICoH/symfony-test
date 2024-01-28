<?php


declare(strict_types=1);

namespace App\Application\Domain\Hash\Service;

use App\Application\Domain\Hash\Enum\Algorithm;

interface HashService
{
    public function hash(Algorithm $algorithm, string $input): string;
}
