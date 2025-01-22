<?php

declare(strict_types=1);

namespace Codelabmw\Testament\Generators;

use Codelabmw\Testament\Contracts\Generator;
use Codelabmw\Testament\Enums\CodeType;

/** @internal */
final class DefaultGenerator implements Generator
{
    /**
     * Generate a code of the given type and length.
     */
    public function generate(CodeType $codeType, int $length): string
    {
        $code = '';

        $generator = function () use ($codeType, $length) {
            for ($i = 0; $i < $length; $i++) {
                yield match ($codeType) {
                    CodeType::NUMERIC => random_int(0, 9),
                    CodeType::ALPHA => chr(random_int(65, 90)),
                    CodeType::ALPHANUMERIC => $this->getRandomAlphanumericCharAscii(),
                    CodeType::PASSWORD => $this->getRandomStrongPasswordChar(),
                };
            }
        };

        foreach ($generator() as $char) {
            $code .= $char;
        }

        return $code;
    }

    /**
     * Get a charecter thats either a letter or number.
     */
    private function getRandomAlphanumericCharAscii(): string
    {
        $asciiMin = 48;
        $asciiMax = 122;

        $randomAscii = random_int($asciiMin, $asciiMax);

        while (($randomAscii > 57 && $randomAscii < 65) || ($randomAscii > 90 && $randomAscii < 97)) {
            $randomAscii = random_int($asciiMin, $asciiMax);
        }

        return chr($randomAscii);
    }

    /**
     * Get a charecter thats either a letter, number or special charecter.
     */
    private function getRandomStrongPasswordChar(): string
    {
        $lowerCaseRange = range(97, 122); // a-z
        $upperCaseRange = range(65, 90); // A-Z
        $numberRange = range(48, 57); // 0-9
        $specialCharRange = range(33, 47) // !"#$%&'()*+,-./
            + range(58, 64) // :;<=>?@
            + range(91, 96); // [\]^_`

        $charTypeRanges = [$lowerCaseRange, $upperCaseRange, $numberRange, $specialCharRange];
        $randomRangeIndex = random_int(0, count($charTypeRanges) - 1);
        $selectedRange = $charTypeRanges[$randomRangeIndex];

        $randomAscii = $selectedRange[random_int(0, count($selectedRange) - 1)];

        return chr($randomAscii);
    }
}
