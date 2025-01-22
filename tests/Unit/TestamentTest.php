<?php

use Codelabmw\Testament\Testament;

it('can generate an alpha code', function (): void {
    // Act
    $code = Testament::alpha();

    // Assert
    expect($code)->toHaveLength(6);
    expect($code)->toMatch('/^[a-zA-Z]+$/');
});

it('can generate a numeric code', function (): void {
    // Act
    $code = Testament::numeric();

    // Assert
    expect($code)->toHaveLength(6);
    expect($code)->toMatch('/^\d+$/');
});

it('can generate an alpha-numeric code', function (): void {
    // Act
    $code = Testament::alphaNumeric(20);

    // Assert
    expect($code)->toHaveLength(20);
    expect($code)->toMatch('/^[a-zA-Z0-9]+$/');
});

it('can generate a password code', function (): void {
    // Act
    $code = Testament::password();

    // Assert
    expect($code)->toHaveLength(8);
    expect($code)->toMatch('/^.*$/');
});
