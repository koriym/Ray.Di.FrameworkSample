<?php

namespace Ray\Sample;

interface FinderInterface
{
    /**
     * @param $name
     *
     * @return array
     */
    public function find($name);
}
