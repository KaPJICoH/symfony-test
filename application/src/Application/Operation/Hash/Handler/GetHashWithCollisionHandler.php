<?php

declare(strict_types=1);

namespace App\Application\Operation\Hash\Handler;

use App\Application\Domain\Hash\DTO\HashWithCollisionDTO;
use App\Application\Domain\Hash\Enum\Algorithm;
use App\Application\Domain\Hash\Repository\HashRepository;
use App\Application\Operation\Hash\Request\GetHashWithCollisionRequest;

class GetHashWithCollisionHandler
{
    public function __construct(private readonly HashRepository $hashRepository)
    {
    }

    public function handle(GetHashWithCollisionRequest $request): HashWithCollisionDTO
    {
        $hash = $this->hashRepository->getOneBy(['result' => $request->hash, 'algorithm' => Algorithm::SHA1->value]);
        $collisions = $this->hashRepository->findCollisions($hash);

        return new HashWithCollisionDTO($hash, $collisions);
    }
}
