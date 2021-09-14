<?php

declare(strict_types=1);

namespace Fp\Callable;

use Generator;

/**
 * REPL:
 * >>> asGenerator(function { yield 1; yield 2; })
 * => Generator(1, 2)
 *
 * @psalm-pure
 * @psalm-template TK
 * @psalm-template TV
 * @psalm-param callable(): iterable<TK, TV> $callback
 * @psalm-return Generator<TK, TV>
 * @psalm-suppress ImpureFunctionCall
 */
function asGenerator(callable $callback): Generator
{
    $iter = $callback();

    if ($iter instanceof Generator) {
        return $iter;
    }

    $generator = function() use ($iter): Generator {
        foreach ($iter as $key => $value) {
            yield $key => $value;
        }
    };

    return $generator();
}

