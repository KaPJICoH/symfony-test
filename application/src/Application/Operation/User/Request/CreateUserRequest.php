<?php

declare(strict_types=1);

namespace App\Application\Operation\User\Request;

use App\Framework\Operation\Request\RequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequest implements RequestInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 50)]
        public readonly string $username,

        #[Assert\NotBlank]
        #[Assert\Length(min: 6, max: 15)]
        public readonly string $password,
    ) {
    }

}
