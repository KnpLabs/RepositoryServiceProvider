<?php

namespace Knp\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

class RepositoryServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app->before(function() use ($app) {
            foreach ($app['repository.repositories'] as $label => $class) {
                $app[$label] = $app->share(function() use ($class, $app) {
                    return new $class($app['db']); 
                });
            }
        });
    }
}
