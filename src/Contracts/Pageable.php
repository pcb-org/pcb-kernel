<?php

namespace PcbKernel\Contracts;

interface Pageable
{
    /**
     * @return int
     */
    public function currentPage();

    /**
     * @return bool
     */
    public function hasMorePages();

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @return array
     */
    public function items();

    /**
     * @return int
     */
    public function perPage();
}
