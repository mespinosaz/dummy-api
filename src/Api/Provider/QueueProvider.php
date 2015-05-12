<?php

namespace Bcn\Api\Provider;

use Bcn\Api\Queue\DummyQueue;
use Silex\Application;
use Silex\ServiceProviderInterface;

class QueueProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        $app['queue'] = $app->share(function () use ($app) {
            return new DummyQueue();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
    }
}
