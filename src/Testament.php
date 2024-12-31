<?php

declare(strict_types=1);

namespace Codelabmw\Testament;

use Codelabmw\Testament\Contracts\Testament as ITestament;
use Codelabmw\Testament\Enums\CodeType;

class Testament implements ITestament
{
    /**
     * Create a new instance of Testament with default settings.
     */
    public static function default(): self
    {
        return new self;
    }

    /**
     * Generates a new cryptographically secure code.
     */
    public function generate(CodeType $type, int $length): string
    {
        $code = '';

        $generator = function () use ($type, $length) {
            for ($i = 0; $i < $length; $i++) {
                yield match ($type) {
                    CodeType::NUMERIC => random_int(0, 9),
                    CodeType::ALPHA => chr(random_int(65, 90)),
                    CodeType::ALPHANUMERIC => chr(random_int(65, 90)).chr(random_int(48, 57)),
                    CodeType::PASSWORD => chr(random_int(65, 90)).chr(random_int(97, 122)).chr(random_int(48, 57)),
                };
            }
        };

        foreach ($generator() as $char) {
            $code .= $char;
        }

        return $code;
    }

    /**
     * Verifies that two given codes are equal.
     */
    public function verify(string $expected, string $actual): bool
    {
        return $expected === $actual;
    }
}
