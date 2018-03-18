<?php

require_once(__DIR__ . '/vendor/autoload.php');

$autoloader = new \iRAP\Autoloader\Autoloader(array(__DIR__));

$config = array(
    'settings' => array(
        'displayErrorDetails' => true
    )
);

$app = new \Slim\App($config);

# Have the controllers register their methods...
FooController::registerWithApp($app);
BarController::registerWithApp($app);

$app->run();