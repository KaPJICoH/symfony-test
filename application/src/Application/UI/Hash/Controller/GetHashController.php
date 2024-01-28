<?php

declare(strict_types=1);

namespace App\Application\UI\Hash\Controller;

use App\Application\Domain\Hash\Model\Hash;
use App\Application\Operation\Hash\Handler\GetHashWithCollisionHandler;
use App\Application\Operation\Hash\Request\GetHashWithCollisionRequest;
use App\Framework\UI\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetHashController extends BaseController
{
    public function __construct(private readonly GetHashWithCollisionHandler $handler)
    {
    }

    #[Route('/hashes/{hash}', name: 'app_get_with_collision_hash', methods: ['GET'])]
    public function __invoke(string $hash): JsonResponse
    {
        $hashWithCollision = $this->handler->handle(new GetHashWithCollisionRequest($hash));

        return new JsonResponse([//should be auto serialization
            'item' => [
                'id' => $hashWithCollision->hash->getId(),
                'algorithm' => $hashWithCollision->hash->getResult(),
                'result' => $hashWithCollision->hash->getAlgorithm(),
                'input' => $hashWithCollision->hash->getInput(),
            ],
            'collisions' => array_map(fn(Hash $hash) => [
                'id' => $hash->getId(),
                'algorithm' => $hash->getResult(),
                'result' => $hash->getAlgorithm(),
                'input' => $hash->getInput(),
            ], $hashWithCollision->collisions)
        ], Response::HTTP_OK);
    }
}
