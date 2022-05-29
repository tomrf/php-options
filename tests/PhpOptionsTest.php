<?php

declare(strict_types=1);

namespace Tomrf\PhpOptions\Test;

use PHPUnit\Framework\TestCase;
use Tomrf\PhpOptions\PhpOptions;
use Tomrf\PhpOptions\PhpOptionsException;

/**
 * @internal
 * @covers \Tomrf\PhpOptions\Directives
 * @covers \Tomrf\PhpOptions\PhpOptions
 * @covers \Tomrf\PhpOptions\PhpOptionsException
 */
final class PhpOptionsTest extends TestCase
{
    public function testPhpOptionsIsInstanceOfPhpOptions(): void
    {
        static::assertInstanceOf(PhpOptions::class, new PhpOptions());
    }

    public function testSetChangableBySystemDirectiveThrowsException(): void
    {
        $this->expectException(PhpOptionsException::class);

        $phpOptions = new PhpOptions();
        $phpOptions->set('allow_url_fopen', '1');
    }

    public function testSetChangablePerDirDirectiveThrowsException(): void
    {
        $this->expectException(PhpOptionsException::class);

        $phpOptions = new PhpOptions();
        $phpOptions->set('auto_append_file', '1');
    }

    public function testSetUnknownDirectiveThrowsException(): void
    {
        $this->expectException(PhpOptionsException::class);

        $phpOptions = new PhpOptions();
        $phpOptions->set('illegal.directive', '0');
    }

    public function testSetEmptyDirectiveThrowsException(): void
    {
        $this->expectException(PhpOptionsException::class);

        $phpOptions = new PhpOptions();
        $phpOptions->set('', '0');
    }

    public function testSetAndGetChangableByAllDirective(): void
    {
        $phpOptions = new PhpOptions();
        static::assertSame('1234M', $phpOptions->set('memory_limit', '1234M'));
        static::assertSame('1234M', $phpOptions->get('memory_limit'));
    }

    public function testGetUnknownDirectiveReturnsFalse(): void
    {
        $phpOptions = new PhpOptions();
        static::assertFalse($phpOptions->get('illegal_directive'));
        static::assertFalse($phpOptions->get('another.illegal_directive'));
    }

    public function testIsKnownDirective(): void
    {
        $phpOptions = new PhpOptions();
        static::assertFalse($phpOptions->isKnownDirective('illegal_directive'));
        static::assertTrue($phpOptions->isKnownDirective('memory_limit'));
    }
}
