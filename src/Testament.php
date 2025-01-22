<?php

declare(strict_types=1);

namespace Codelabmw\Testament;

use Codelabmw\Testament\Contracts\Generator;
use Codelabmw\Testament\Enums\CodeType;
use Codelabmw\Testament\Generators\DefaultGenerator;

final class Testament
{
    /**
     * Keeps track of current Testament instance.
     */
    private static ?self $instance = null;

    /**
     * Creates a private instance of Testament.
     */
    private function __construct(private readonly Generator $generator) {}

    /**
     * A private Testament factory using DefaultGenerator.
     */
    private static function make(): static
    {
        if (! self::$instance instanceof \Codelabmw\Testament\Testament) {
            self::$instance = new self(new DefaultGenerator);
        }

        return self::$instance;
    }

    /**
     * Generate an alphabetical code of the given length (Defaults to 6).
     */
    public static function alpha(int $length = 6): string
    {
        return self::make()->generator->generate(CodeType::ALPHA, $length);
    }

    /**
     * Generate a numeric code of the given length (Defaults to 6).
     */
    public static function numeric(int $length = 6): string
    {
        return self::make()->generator->generate(CodeType::NUMERIC, $length);
    }

    /**
     * Generate an alpha-numeric code of the given length (Defaults to 6).
     */
    public static function alphaNumeric(int $length = 6): string
    {
        return self::make()->generator->generate(CodeType::ALPHANUMERIC, $length);
    }

    /**
     * Generate a password code of the given length (Defaults to 8).
     */
    public static function password(int $length = 8): string
    {
        return self::make()->generator->generate(CodeType::PASSWORD, $length);
    }
}
