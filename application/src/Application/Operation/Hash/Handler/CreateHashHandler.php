<?php

declare(strict_types=1);

namespace App\Application\Operation\Hash\Handler;

use App\Application\Domain\Hash\Enum\Algorithm;
use App\Application\Domain\Hash\Factory\HashFactory;
use App\Application\Domain\Hash\Model\Hash;
use App\Application\Domain\Hash\Repository\HashRepository;
use App\Application\Domain\Hash\Service\HashService;
use App\Application\Operation\Hash\Request\CreateHashRequest;

class CreateHashHandler
{
    public function __construct(private readonly HashService $hashService, private readonly HashRepository $hashRepository, private readonly HashFactory $hashFactory)
    {
    }

    public function handle(CreateHashRequest $request): Hash
    {
        $result = $this->hashService->hash(Algorithm::SHA1, $request->data);
        $hash = $this->hashFactory->create(Algorithm::SHA1, $request->data, $result);
        $this->hashRepository->save($hash);

        return $hash;
    }
}
