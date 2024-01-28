<?php

declare(strict_types=1);

namespace App\Application\UI\Hash\Controller;

use App\Application\Operation\Hash\Handler\CreateHashHandler;
use App\Application\Operation\Hash\Request\CreateHashRequest;
use App\Framework\UI\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateHashController extends BaseController
{
    public function __construct(private readonly CreateHashHandler $handler)
    {
    }

    #[Route('/hashes', name: 'app_create_hash', methods: ['POST'])]
    public function __invoke(CreateHashRequest $request): JsonResponse
    {
        $hash = $this->handler->handle($request);

        return new JsonResponse(['hash' => $hash->hash, 'is_have_collision' => $hash->isHaveCollision], Response::HTTP_CREATED);//should be auto serialization
    }
}
