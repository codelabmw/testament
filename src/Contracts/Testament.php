<?php

declare(strict_types=1);

namespace Codelabmw\Testament\Contracts;

use Codelabmw\Testament\Enums\CodeType;

/**
 * @internal description
 */
interface Testament
{
    /**
     * Generates a new cryptographically secure code.
     */
    public function generate(CodeType $type, int $length): string;

    /**
     * Verifies that two given codes are equal.
     */
    public function verify(string $expected, string $actual): bool;
}
