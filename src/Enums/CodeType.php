<?php

declare(strict_types=1);

namespace Codelabmw\Testament\Enums;

enum CodeType
{
    case NUMERIC;
    case ALPHA;
    case ALPHANUMERIC;
    case PASSWORD;
}
