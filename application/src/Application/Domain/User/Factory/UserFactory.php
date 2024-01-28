<?php

declare(strict_types=1);

namespace App\Application\Domain\User\Factory;

use App\Application\Domain\User\Model\User;

class UserFactory
{
    public function create(string $username, string $password): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);

        return $user;
    }

}
