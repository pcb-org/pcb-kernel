<?php

namespace PcbKernel\Contracts;

use Countable;
use IteratorAggregate;
use JsonSerializable;

interface Collectionable extends Countable, IteratorAggregate, JsonSerializable, Arrayable, Jsonable
{
    /**
     * @return array
     */
    public function all();

    /**
     * @param iterable $source
     * @return static
     */
    public function concat($source);

    /**
     * @param mixed $items
     * @return static
     */
    public function diff($items);

    /**
     * @param callable $callback
     * @return $this
     */
    public function each(callable $callback);

    /**
     * @param callable $callback
     * @return bool
     */
    public function every(callable $callback);

    /**
     * @param callable|null $callback
     * @return static
     */
    public function filter(callable $callback = null);

    /**
     * @param callable|null $callback
     * @param mixed $default
     * @return mixed
     */
    public function first(callable $callback = null, $default = null);

    /**
     * @param int $depth
     * @return static
     */
    public function flatten($depth = INF);

    /**
     * @param string|int|array $keys
     * @return $this
     */
    public function forget($keys);

    /**
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @param mixed $key
     * @return bool
     */
    public function has($key);

    /**
     * @param mixed $items
     * @return static
     */
    public function intersect($items);

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @param callable|null $callback
     * @param mixed $default
     * @return mixed
     */
    public function last(callable $callback = null, $default = null);

    /**
     * @param mixed $items
     * @return static
     */
    public static function make($items = []);

    /**
     * @param callable $callback
     * @return static
     */
    public function map(callable $callback);

    /**
     * @param callable $callback
     * @return static
     */
    public function mapWithKeys(callable $callback);

    /**
     * @param mixed $values
     * @return $this
     */
    public function push(...$values);

    /**
     * @param mixed $key
     * @param mixed $value
     * @return $this
     */
    public function put($key, $value);

    /**
     * @param callable $callback
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null);

    /**
     * @param int $offset
     * @param int|null $length
     * @return static
     */
    public function slice($offset, $length = null);

    /**
     * @param callable $callback
     * @return bool
     */
    public function some(callable $callback);

    /**
     * @param callable|int|null $callback
     * @return static
     */
    public function sort($callback = null);

    /**
     * @param mixed $items
     * @return static
     */
    public function union($items);

    /**
     * @param string|callable|null $key
     * @param bool $strict
     * @return static
     */
    public function unique($key = null, $strict = false);

    /**
     * @param mixed $value
     * @return static
     */
    public static function wrap($value);
}
