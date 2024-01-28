<?php

declare(strict_types=1);

namespace App\Application\Domain\Hash\DTO;

class HashingResult
{
    public function __construct(public string $hash, public bool $isHaveCollision)
    {
    }
}
