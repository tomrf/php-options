<?php

declare(strict_types=1);

namespace Tomrf\PhpOptions;

/**
 * PhpOptions.
 */
class PhpOptions extends PhpOptionDirectives
{
    public function get(string $option): string|false
    {
        return ini_get($option);
    }

    public function set(string $option, string $value): string
    {
        $changable = self::DIRECTIVES[$option][1] ?? 'UNKNOWN';

        if ('PHP_INI_SYSTEM' === $changable || 'PHP_INI_PERDIR' === $changable) {
            throw new PhpOptionsException(sprintf(
                'Unable to set directive "%s": only changable by %s',
                $option,
                $changable
            ));
        }

        if (false === ini_set($option, $value)) {
            if (!$this->isKnownDirective($option)) {
                throw new PhpOptionsException(sprintf(
                    'Failed to set unknown directive "%s": ini_set() returned false',
                    $option
                ));
            }

            throw new PhpOptionsException(sprintf(
                'Failed to set directive "%s": ini_set() returned false',
                $option
            ));
        }

        $setValue = ini_get($option);

        if (false === $setValue || (string) $setValue !== (string) $value) {
            throw new PhpOptionsException(sprintf(
                'Failed to set directive "%s": new value verification failed: %s = "%s"',
                $option,
                $option,
                $setValue
            ));
        }

        return $setValue;
    }

    public function isKnownDirective(string $option): bool
    {
        return isset(self::DIRECTIVES[$option]);
    }
}
