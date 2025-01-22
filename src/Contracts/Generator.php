<?php

declare(strict_types=1);

namespace Codelabmw\Testament\Contracts;

use Codelabmw\Testament\Enums\CodeType;

/** @internal */
interface Generator
{
    /**
     * Generate a code of the given type and length.
     */
    public function generate(CodeType $codeType, int $length): string;
}
