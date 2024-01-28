<?php

declare(strict_types=1);

namespace App\Application\Operation\Hash\Request;

use App\Framework\Operation\Request\RequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class GetHashWithCollisionRequest implements RequestInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(max: 255)]
        public string $hash,
    )
    {
    }
}
