<?php

namespace Knp\Provider;

use Silex\ServiceProviderInterface;
use Silex\Application;

class RepositoryServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
    }

    public function boot(Application $app)
    {
        foreach ($app['repository.repositories'] as $label => $class) {
            $app[$label] = $app->share(function($app) use ($class) {
                return new $class($app['db']); 
            });
        }
    }
}
