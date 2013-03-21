<?php

namespace Ray\Sample\bootstrap {

    use Doctrine\Common\Annotations\AnnotationRegistry;
    use Ray\Di\Injector;
    use Ray\Sample\Framework\Controller;
    use Ray\Sample\MockFinder;
    use Ray\Sample\MovieLister;

    require __DIR__ . '/vendor/autoload.php';

    (new Controller(new MovieLister(new MockFinder)))->index();
}

/**
 * Dependency Injection by hand
 */
namespace Ray\Sample\Framework {

    use Ray\Sample\MovieListerInterface;

    class Controller
    {
        public function __construct(MovieListerInterface $movieLister)
        {
            $this->movieLister = $movieLister;
        }

        public function index()
        {
            $found = $this->movieLister->findMovie('SF');

            var_dump($found);
        }
    }
}
