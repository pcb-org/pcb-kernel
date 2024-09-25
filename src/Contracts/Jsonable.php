<?php

namespace PcbKernel\Contracts;

interface Jsonable
{
    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0);
}
