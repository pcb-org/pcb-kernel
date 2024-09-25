<?php

namespace PcbKernel\Pagination;

use ArrayIterator;
use PcbKernel\Support\Collection;

abstract class AbstractPaginator
{
    /**
     * @var \PcbKernel\Support\Collection
     */
    protected $items;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var int
     */
    protected $perPage;

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->items->count();
    }

    /**
     * @return int
     */
    public function currentPage()
    {
        return $this->currentPage;
    }

    /**
     * @return \PcbKernel\Support\Collection
     */
    public function getCollection()
    {
        return $this->items;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return $this->items->getIterator();
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->items->isEmpty();
    }

    /**
     * @return array
     */
    public function items()
    {
        return $this->items->all();
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return $this->items->has($key);
    }

    /**
     * @param mixed $key
     * @return mixed
     */
    public function offsetGet($key): mixed
    {
        return $this->items->get($key);
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function offsetSet($key, $value): void
    {
        $this->items->put($key, $value);
    }

    /**
     * @param mixed $key
     * @return void
     */
    public function offsetUnset($key): void
    {
        $this->items->forget($key);
    }

    /**
     * @return int
     */
    public function perPage()
    {
        return $this->perPage;
    }

    /**
     * @param \PcbKernel\Support\Collection $collection
     * @return $this
     */
    public function setCollection(Collection $collection)
    {
        $this->items = $collection;

        return $this;
    }
}
