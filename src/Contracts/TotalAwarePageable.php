<?php

namespace PcbKernel\Contracts;

interface TotalAwarePageable extends Pageable
{
    /**
     * @return int
     */
    public function lastPage();

    /**
     * @return int
     */
    public function total();
}
