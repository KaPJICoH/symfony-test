<?php

declare(strict_types=1);

namespace App\Framework\Domain\Exception;

class ResourceNotFound extends BaseException
{
    public function __construct(string $message = "Resource not found", int $code = 404, ?string $where = null)
    {
        parent::__construct($message, $code, $where);
    }
}
