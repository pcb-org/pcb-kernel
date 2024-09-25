<?php

namespace PcbKernel\Tests;

use PcbKernel\Pagination\Paginator;
use PcbKernel\Support\Collection;
use PHPUnit\Framework\TestCase;

class PaginatorTest extends TestCase
{
    protected $paginator;

    protected function setUp(): void
    {
        $items = new Collection([1, 2, 3, 4, 5, 6, 7]);
        $perPage = 5;
        $currentPage = 1;

        $this->paginator = new Paginator($items, $perPage, $currentPage);
    }

    public function testToArray()
    {
        $expected = [
            'current_page' => 1,
            'data' => [1, 2, 3, 4, 5],
            'has_more_pages' => true,
            'per_page' => 5,
        ];

        $this->assertEquals($expected, $this->paginator->toArray());
    }

    public function testHasMorePages()
    {
        $this->assertTrue($this->paginator->hasMorePages());

        $paginatorNoMorePages = new Paginator(new Collection([1, 2]), 5, 1);
        $this->assertFalse($paginatorNoMorePages->hasMorePages());
    }

    public function testJsonSerialize()
    {
        $expected = json_encode([
            'current_page' => 1,
            'data' => [1, 2, 3, 4, 5],
            'has_more_pages' => true,
            'per_page' => 5,
        ]);

        $this->assertJsonStringEqualsJsonString($expected, json_encode($this->paginator));
    }

    public function testToJson()
    {
        $expectedJson = json_encode([
            'current_page' => 1,
            'data' => [1, 2, 3, 4, 5],
            'has_more_pages' => true,
            'per_page' => 5,
        ]);

        $this->assertJsonStringEqualsJsonString($expectedJson, $this->paginator->toJson());
    }
}
