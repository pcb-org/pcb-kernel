<?php

namespace PcbKernel\Pagination;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use PcbKernel\Contracts\Arrayable;
use PcbKernel\Contracts\Jsonable;
use PcbKernel\Contracts\TotalAwarePageable;
use PcbKernel\Support\Collection;

class TotalAwarePaginator extends AbstractPaginator implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable, Arrayable, Jsonable, TotalAwarePageable
{
    /**
     * @var int
     */
    protected $lastPage;

    /**
     * @var int
     */
    protected $total;

    /**
     * @param mixed $items
     * @param int $total
     * @param int $perPage
     * @param int $currentPage
     * @return void
     */
    public function __construct($items, $total, $perPage, $currentPage)
    {
        $this->total = $total;
        $this->perPage = $perPage;
        $this->lastPage = max((int) ceil($total / $perPage), 1);
        $this->currentPage = $currentPage;
        $this->items = $items instanceof Collection ? $items : Collection::make($items);
    }

    /**
     * @return bool
     */
    public function hasMorePages()
    {
        return $this->currentPage() < $this->lastPage();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return int
     */
    public function lastPage()
    {
        return $this->lastPage;
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
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'total' => $this->total(),
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

    /**
     * @return int
     */
    public function total()
    {
        return $this->total;
    }
}
