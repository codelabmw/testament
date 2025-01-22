<?php

use Codelabmw\Testament\Contracts\Generator;

arch()->preset()->php();
arch()->preset()->security();
arch()->preset()->strict();

arch('generators implements generator contract')
    ->expect('Codelabmw\Testament\Generators')
    ->toImplement(Generator::class);

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray', 'var_dump'])
    ->each->not->toBeUsed();
