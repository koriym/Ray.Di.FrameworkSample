<?php

namespace Ray\Sample\bootstrap {

    use Doctrine\Common\Annotations\AnnotationRegistry;
    use Ray\Di\Injector;
    use Ray\Sample\Framework\Controller;

    $loader = require __DIR__ . '/vendor/autoload.php';
    AnnotationRegistry::registerLoader([$loader, 'loadClass']);

    $di = Injector::create()->getContainer();
    $di->set('finder', $di->lazyNew('Ray\Sample\MockFinder'));
    $di->set(
        'movie.lister',
        function () use ($di) {
            return $di->newInstance(
                'Ray\Sample\MovieLister',
                [
                    'finder' => $di->get('finder')
                ]
            );
        }
    );
    $di->params['\Ray\Sample\Framework\Controller'] = [
        'movieLister' => $di->lazyGet('movie.lister')
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
