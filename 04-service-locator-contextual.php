<?php

namespace Ray\Sample\bootstrap {

    // loader

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

    (new Controller($container))->index();
}

/**
 * Contextualized Dependency Lookup (CDL)
 */
namespace Ray\Sample\Framework {

    use Aura\Di\ContainerInterface;

    class Controller
    {
        /**
         * @var \Ray\Sample\MovieLister
         */
        private $movieLister;

        public function __construct(ContainerInterface $container)
        {
            $this->movieLister = $container->get('movie.lister');
        }

        public function index()
        {
            $found = $this->movieLister->findMovie('SF');

            var_dump($found);
        }
    }
}
