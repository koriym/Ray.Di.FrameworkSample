<?php

namespace Ray\Sample\bootstrap {

    // loader

    use Doctrine\Common\Annotations\AnnotationRegistry;
    use Ray\Di\Injector;
    use Ray\Sample\Framework\Controller;
    use Ray\Sample\MockFinder;
    use Ray\Sample\MovieLister;

    require __DIR__ . '/vendor/autoload.php';

    $di = Injector::create()->getContainer();
    $di->params['\Ray\Sample\Framework\Controller'] = [
        'movieLister' => new MovieLister(new MockFinder)
    ];
    $controller = $di->newInstance('\Ray\Sample\Framework\Controller');
    $controller->index();
}

/**
 * Dependency injection
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
