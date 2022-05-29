<?php

declare(strict_types=1);

namespace Tomrf\PhpOptions\Test;

use PHPUnit\Framework\TestCase;
use Tomrf\PhpOptions\PhpOptions;

/**
 * @internal
 * @covers \Tomrf\PhpOptions\PhpOptions
 */
final class PhpOptionsTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        // ...
    }

    public function testPhpOptionsIsInstanceOfPhpOptions(): void
    {
        static::assertInstanceOf(PhpOptions::class, new PhpOptions());
    }

    public function testGetClass(): void
    {
        static::assertSame(PhpOptions::class, (new PhpOptions())->getClass());
    }
}
