<?php

namespace Ray\Sample\bootstrap {

    use Ray\Sample\Framework\Controller;

    require __DIR__ . '/vendor/autoload.php';

    (new Controller)->index();
}

/**
 * Hard dependency (Dependency Pull)
 */
namespace Ray\Sample\Framework {

    use Ray\Sample\MockFinder;
    use Ray\Sample\MovieLister;

    class Controller
    {
        public function __construct()
        {
            $this->movieLister = new MovieLister(new MockFinder);
        }

        public function index()
        {

            $found = $this->movieLister->findMovie('SF');

            var_dump($found);
        }
    }
}
