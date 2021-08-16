<?php

declare(strict_types=1);

namespace Fp\Collections;

use Fp\Functional\Option\Option;

/**
 * @template TK of (object|scalar)
 * @template-covariant TV
 * @psalm-immutable
 */
interface MapOps
{
    /**
     * Get an element by its key
     * Alias for @see MapOps::get
     *
     * @param TK $key
     * @return Option<TV>
     */
    public function __invoke(mixed $key): Option;

    /**
     * Get an element by its key
     *
     * @param TK $key
     * @return Option<TV>
     */
    public function get(mixed $key): Option;

    /**
     * Produces new collection with given element
     *
     * @template TKI of (object|scalar)
     * @template TVI
     * @param TKI $key
     * @param TVI $value
     * @return Map<TK|TKI, TV|TVI>
     */
    public function updated(mixed $key, mixed $value): Map;

    /**
     * Produces new collection without an element with given key
     *
     * @param TK $key
     * @return Map<TK, TV>
     */
    public function removed(mixed $key): Map;

    /**
     * Returns true if every collection element satisfy the condition
     * false otherwise
     *
     * @psalm-param callable(TV, TK): bool $predicate
     */
    public function every(callable $predicate): bool;

    /**
     * Filter collection by condition
     *
     * @psalm-param callable(TV, TK): bool $predicate
     * @psalm-return Map<TK, TV>
     */
    public function filter(callable $predicate): Map;

    /**
     * Map collection and flatten the result
     *
     * @psalm-template TKO of (object|scalar)
     * @psalm-template TVO
     * @psalm-param callable(TV, TK): iterable<array{TKO, TVO}> $callback
     * @psalm-return Map<TKO, TVO>
     */
    public function flatMap(callable $callback): Map;

    /**
     * Fold many pairs of key-value into one
     *
     * @psalm-param array{TK, TV} $init initial accumulator value
     * @psalm-param callable(array{TK, TV}, array{TK, TV}): array{TK, TV} $callback (accumulator, current element): new accumulator
     * @psalm-return array{TK, TV}
     */
    public function fold(array $init, callable $callback): array;

    /**
     * Reduce multiple elements into one
     * Returns None for empty collection
     *
     * @psalm-param callable(array{TK, TV}, array{TK, TV}): array{TK, TV} $callback (accumulator, current value): new accumulator
     * @psalm-return Option<array{TK, TV}>
     */
    public function reduce(callable $callback): Option;

    /**
     * Produces a new collection of elements by mapping each element in collection
     * through a transformation function (callback)
     *
     * @template TVO
     * @psalm-param callable(TV, TK): TVO $callback
     * @psalm-return Map<TK, TVO>
     */
    public function map(callable $callback): Map;

    /**
     * Produces a new collection of elements by assigning the values to keys generated by a transformation function (callback).
     *
     * @template TKO of (object|scalar)
     * @psalm-param callable(TV, TK): TKO $callback
     * @psalm-return Map<TKO, TV>
     */
    public function reindex(callable $callback): Map;


    /**
     * Returns sequence of collection keys
     *
     * @psalm-return Seq<TK>
     */
    public function keys(): Seq;

    /**
     * Returns sequence of collection values
     *
     * @psalm-return Seq<TV>
     */
    public function values(): Seq;
}
