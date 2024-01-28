<?php

declare(strict_types=1);

namespace App\Application\Domain\Hash\Factory;

use App\Application\Domain\Hash\Enum\Algorithm;
use App\Application\Domain\Hash\Model\Hash;

class HashFactory
{
    public function create(Algorithm $algorithm, string $input, string $result): Hash
    {
        $user = new Hash();
        $user->setAlgorithm($algorithm);
        $user->setInput($input);
        $user->setResult($result);

        return $user;
    }

}
