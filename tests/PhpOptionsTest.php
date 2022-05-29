<?php

declare(strict_types=1);

namespace Tomrf\PhpOptions\Test;

use PHPUnit\Framework\TestCase;
use Tomrf\PhpOptions\PhpOptions;
use Tomrf\PhpOptions\PhpOptionsException;

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

    public function testSetSystemOnlyDirectivesThrowsException(): void
    {
        $this->expectException(PhpOptionsException::class);

        $phpOptions = new PhpOptions();
        $phpOptions->setOption('allow_url_fopen', '1');
    }

    public function testSetUnknownDirectiveThrowsException(): void
    {
        $this->expectException(PhpOptionsException::class);

        $phpOptions = new PhpOptions();
        $phpOptions->setOption('illegal.directive', '0');
    }

    public function testSetEmptyDirectiveThrowsException(): void
    {
        $this->expectException(PhpOptionsException::class);

        $phpOptions = new PhpOptions();
        $phpOptions->setOption('', '0');
    }
}
