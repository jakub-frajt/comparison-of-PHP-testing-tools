<?php
declare(strict_types=1);

namespace App\PhpUnit\Examples\Exceptions;

class FooClass
{
    public function throwRuntimeException(): void
    {
        throw new \RuntimeException('It\'s a message for an exception.', 20);
    }
}
