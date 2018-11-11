<?php
declare(strict_types=1);

namespace App\Tests\PhpUnit\Examples;

use App\PhpUnit\Examples\Exceptions\FooClass;
use PHPUnit\Framework\TestCase;

class ExceptionsTest extends TestCase
{
    public function testException(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionCode(20);
        $this->expectExceptionMessage('It\'s a message for an exception.');
        $this->expectExceptionMessageRegExp('/message/');

        (new FooClass())->throwRuntimeException();
    }
}
