<?php

namespace Ray\Sample;

class MockFinder implements FinderInterface
{
    /**
     * @param $name
     *
     * @return array
     */
    public function find($name)
    {
        return ['2001: A Space Odyssey ', 'Solaris', 'Kin-dza-dza!'];
    }
}
