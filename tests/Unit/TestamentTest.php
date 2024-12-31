<?php

use Codelabmw\Testament\Enums\CodeType;
use Codelabmw\Testament\Testament;

it('can creare a testament instance with default static method', function (): void {
    $testament = Testament::default();

    expect($testament)->toBeInstanceOf(Testament::class);
});

it('can generate a code with correct length', function (): void {
    $testament = Testament::default();
    $code = $testament->generate(type: CodeType::NUMERIC, length: 6);

    expect($code)->toHaveLength(6);
});

it('can generate a numeric code', function (): void {
    $testament = Testament::default();
    $code = $testament->generate(type: CodeType::NUMERIC, length: 6);

    expect($code)->toMatch('/^\d+$/');
});

it('can generate an alphabetical code', function (): void {
    $testament = Testament::default();
    $code = $testament->generate(type: CodeType::ALPHA, length: 6);

    expect($code)->toMatch('/^[a-zA-Z]+$/');
});

it('can generate an alphanumeric code', function (): void {
    $testament = Testament::default();
    $code = $testament->generate(type: CodeType::ALPHANUMERIC, length: 6);

    expect($code)->toMatch('/^[a-zA-Z0-9]+$/');
});

it('can generate a password code', function (): void {
    $testament = Testament::default();
    $code = $testament->generate(type: CodeType::PASSWORD, length: 6);

    expect($code)->toMatch('/^[a-zA-Z0-9!@#$%^&*()]+$/');
});

it('can verify that two codes are equal', function (): void {
    $testament = Testament::default();
    $expected = '123456';
    $actual = '123456';

    expect($testament->verify($expected, $actual))->toBeTrue();
});

it('can verify that two codes are not equal', function (): void {
    $testament = Testament::default();
    $expected = '123456';
    $actual = '654321';

    expect($testament->verify($expected, $actual))->toBeFalse();
});
