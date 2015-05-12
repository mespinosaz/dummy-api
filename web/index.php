<?php

require_once '../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Bcn\Api\Provider\QueueProvider());

$app->mount('/', new Bcn\Api\Provider\ControllerProvider($app));

$app->run();