<?php

namespace Bcn\Api\Provider;

use Bcn\Api\Controller\OrdersController;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\Provider\ServiceControllerServiceProvider;

class ControllerProvider implements ControllerProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $app->register(new ServiceControllerServiceProvider());
        $controllers = $app['controllers_factory'];

        $app['orders.controller'] = $app->share(function () use ($app) {
            return new OrdersController($app['queue']);
        });

        $controllers->post('/orders', 'orders.controller:postAction');
        $controllers->get('/orders/{orderId}', 'orders.controller:getAction');

        return $controllers;
    }
}
