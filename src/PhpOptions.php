<?php

declare(strict_types=1);

namespace Tomrf\PhpOptions;

/**
 * PhpOptions.
 */
class PhpOptions
{
    public function getOption(string $option): string|false
    {
        return ini_get($option);
    }

    public function setOption(string $option, string $value): string|false
    {
        if (!isset(Directives::DIRECTIVES[$option])) {
            throw new PhpOptionsException(sprintf('No such PHP configuration directive: "%s"', $option));
        }

        $changable = Directives::DIRECTIVES[$option][1] ?? '';

        if ('PHP_INI_SYSTEM' === $changable) {
            throw new PhpOptionsException(sprintf(
                'Unable to set directive "%s": only changable by %s',
                $option,
                $changable
            ));
        }

        return ini_set($option, $value);
    }
}
