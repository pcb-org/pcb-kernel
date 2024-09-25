<?php

namespace PcbKernel\Pagination;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use PcbKernel\Contracts\Arrayable;
use PcbKernel\Contracts\Jsonable;
use PcbKernel\Contracts\Pageable;
use PcbKernel\Support\Collection;

class Paginator extends AbstractPaginator implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable, Arrayable, Jsonable, Pageable
{
    /**
     * @return bool
     */
    protected $hasMore;

    /**
     * @param mixed $items
     * @param int $perPage
     * @param int $currentPage
     * @return void
     */
    public function __construct($items, $perPage, $currentPage)
    {
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->items = $items instanceof Collection ? $items : Collection::make($items);
        $this->hasMore = $this->items->count() > $this->perPage;
        $this->items = $this->items->slice(0, $this->perPage);
    }

    /**
     * @return bool
     */
    public function hasMorePages()
    {
        return $this->hasMore;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'current_page' => $this->currentPage(),
            'data' => $this->items->toArray(),
            'has_more_pages' => $this->hasMorePages(),
            'per_page' => $this->perPage(),
        ];
    }

    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }
}
