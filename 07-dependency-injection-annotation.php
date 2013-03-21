<?php

namespace Ray\Sample\bootstrap {

    use Doctrine\Common\Annotations\AnnotationRegistry;
    use Ray\Di\AbstractModule;
    use Ray\Di\Injector;
    use Ray\Sample\Framework\Controller;

    $loader = require __DIR__ . '/vendor/autoload.php';
    AnnotationRegistry::registerLoader([$loader, 'loadClass']);

    class Module extends AbstractModule
    {
        protected function configure()
        {
            $this->bind('Ray\Sample\FinderInterface')->to('Ray\Sample\MockFinder');
            $this->bind('Ray\Sample\MovieListerInterface')->to('Ray\Sample\MovieLister');
        }
    }

    $di = Injector::create([new Module]);
    $controller = $di->getInstance('\Ray\Sample\Framework\Controller');
    $controller->index();
}

/**
 * Annotation based dependency injection (JSR-330)
 * @see http://code.google.com/p/google-guice/wiki/JSR330
 */
namespace Ray\Sample\Framework {

    use Ray\Sample\MovieListerInterface;
    use Ray\Di\Di\Inject;

    class Controller
    {
        /**
         * @param MovieListerInterface $movieLister
         *
         * @Inject
         */
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
