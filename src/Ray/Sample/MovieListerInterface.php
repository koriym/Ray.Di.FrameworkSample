<?php

namespace Ray\Sample;

interface MovieListerInterface
{
    /**
     * @param FinderInterface $finder
     */
    public function __construct(FinderInterface $finder);

    /**
     * @param $name
     *
     * @return array
     */
    public function findMovie($name);
}
