<?php

declare(strict_types=1);

namespace App\Application\Domain\Hash\Enum;

enum Algorithm: string
{
    case MD5 = 'md5';
    case SHA1 = 'sha1';
    case SHA256 = 'sha256';
    case SHA512 = 'sha512';
}
