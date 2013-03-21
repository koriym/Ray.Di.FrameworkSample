<?php

namespace Ray\Sample\bootstrap {

    use Doctrine\Common\Annotations\AnnotationRegistry;
    use Ray\Di\Injector;
    use Ray\Sample\Framework\Controller;
    use Ray\Sample\MockFinder;
    use Ray\Sample\MovieLister;

    require __DIR__ . '/vendor/autoload.php';

    $container = Injector::create()->getContainer();
    $lazy = $container->lazy(
        function () {
            return new MovieLister(new MockFinder);
        }
    );
    $container->set('movie.lister', $lazy);
    $GLOBALS['service_locator'] = $container;
    (new Controller)->index();
}

/**
 * Global registry - lazy load
 */
namespace Ray\Sample\Framework {

    class Controller
    {
        public function index()
        {
            $movieLister = $GLOBALS['service_locator']->get('movie.lister');
            $found = $movieLister->findMovie('SF');

            var_dump($found);
        }
    }
}
