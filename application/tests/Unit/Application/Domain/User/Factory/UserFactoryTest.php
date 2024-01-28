<?php

declare(strict_types=1);

namespace App\Unit\Application\Domain\User\Factory;

use App\Application\Domain\User\Factory\UserFactory;
use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{
    public function testCreate()
    {
        $user = (new UserFactory())->create('username', 'password');
        $this->assertEquals('username', $user->getUsername());
        $this->assertEquals('password', $user->getPassword());
    }
}
