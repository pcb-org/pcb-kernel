<?php

namespace PcbKernel\Tests;

use PcbKernel\Pagination\TotalAwarePaginator;
use PcbKernel\Support\Collection;
use PHPUnit\Framework\TestCase;

class TotalAwarePaginatorTest extends TestCase
{
    protected $paginator;

    protected function setUp(): void
    {
        $items = new Collection([1, 2, 3, 4, 5]);
        $total = 20;
        $perPage = 5;
        $currentPage = 1;

        $this->paginator = new TotalAwarePaginator($items, $total, $perPage, $currentPage);
    }

    public function testToArray()
    {
        $expected = [
            'current_page' => 1,
            'data' => [1, 2, 3, 4, 5],
            'has_more_pages' => true,
            'last_page' => 4,
            'per_page' => 5,
            'total' => 20,
        ];

        $this->assertEquals($expected, $this->paginator->toArray());
    }

    public function testHasMorePages()
    {
        $this->assertTrue($this->paginator->hasMorePages());

        $this->paginator = new TotalAwarePaginator(new Collection([16, 17, 18, 19, 20]), 20, 5, 4);
        $this->assertFalse($this->paginator->hasMorePages());
    }

    public function testJsonSerialize()
    {
        $expected = json_encode([
            'current_page' => 1,
            'data' => [1, 2, 3, 4, 5],
            'has_more_pages' => true,
            'last_page' => 4,
            'per_page' => 5,
            'total' => 20,
        ]);

        $this->assertJsonStringEqualsJsonString($expected, json_encode($this->paginator));
    }

    public function testTotal()
    {
        $this->assertEquals(20, $this->paginator->total());
    }
}
