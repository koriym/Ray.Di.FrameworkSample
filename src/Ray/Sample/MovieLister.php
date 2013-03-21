<?php

namespace Ray\Sample;

use Ray\Di\Di\Inject;

class MovieLister implements MovieListerInterface
{
    private $finder;

    /**
     * @param FinderInterface $finder
     *
     * @Inject
     */
    public function __construct(FinderInterface $finder)
    {
        $this->finder = $finder;
    }

    /**
     * {@inheritdoc}
     */
    public function findMovie($name)
    {
        return $this->finder->find($name);
    }
}
