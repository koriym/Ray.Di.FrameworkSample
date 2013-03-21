<?php

namespace Ray\Sample\bootstrap {

    use Doctrine\Common\Annotations\AnnotationRegistry;
    use Ray\Di\Injector;
    use Ray\Sample\Framework\Controller;
    use Ray\Sample\MockFinder;
    use Ray\Sample\MovieLister;

    require __DIR__ . '/vendor/autoload.php';

    // service locator setup
    $container = Injector::create()->getContainer();
    $container->set('movie.lister', new MovieLister(new MockFinder));
    $GLOBALS['service_locator'] = $container;
    (new Controller)->index();
}

/**
 * Global registry
 */
namespace Ray\Sample\Framework {

    class Controller
    {
        public function __construct()
        {
            $this->movieLister = $GLOBALS['service_locator']->get('movie.lister');
        }

        public function index()
        {
            $found = $this->movieLister->findMovie('SF');

            var_dump($found);
        }
    }
}
