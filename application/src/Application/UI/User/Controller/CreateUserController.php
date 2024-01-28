<?php

declare(strict_types=1);

namespace App\Application\UI\User\Controller;

use App\Application\Operation\User\Handler\CreateUserHandler;
use App\Application\Operation\User\Request\CreateUserRequest;
use App\Framework\UI\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserController extends BaseController
{
    public function __construct(private readonly CreateUserHandler $handler)
    {
    }

    #[Route('/users', name: 'app_create_user', methods: ['POST'])]
    public function __invoke(CreateUserRequest $request): JsonResponse
    {
        $this->handler->handle($request);

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
