<?php

declare(strict_types=1);

namespace App\Application\Operation\User\Handler;

use App\Application\Domain\User\Factory\UserFactory;
use App\Application\Domain\User\Repository\UserRepository;
use App\Application\Operation\User\Request\CreateUserRequest;

class CreateUserHandler
{

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserFactory    $userFactory
    )
    {
    }

    public function handle(CreateUserRequest $request)
    {
        $user = $this->userFactory->create($request->username, $request->password);
        $this->userRepository->save($user);
    }
}
