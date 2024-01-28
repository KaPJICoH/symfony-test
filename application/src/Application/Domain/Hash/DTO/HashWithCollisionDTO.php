<?php

declare(strict_types=1);

namespace App\Application\Domain\Hash\DTO;

use App\Application\Domain\Hash\Model\Hash;

class HashWithCollisionDTO
{
    /**
     * @param Hash[] $collisions
     */
    public function __construct(public Hash $hash, public array $collisions)
    {
    }
}
