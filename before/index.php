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
$app->group('/v1', function () use ($app) {
    $app->group('/bar', function () use ($app) {
        // create
        $app->post('', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $barController = new BarController($request, $response, $args);
            $allPostPutVars = $request->getParsedBody();
            return $barController->create($allPostPutVars);
        });

        // read all
        $app->get('', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $barController = new BarController($request, $response, $args);
            return $barController->getAll();
        });

        // read single
        $app->get('/{uuid}', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $barController = new BarController($request, $response, $args);
            $uuid = $args['uuid'];
            return $barController->get($uuid);
        });

        // update
        $app->put('/{uuid}', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $barController = new BarController($request, $response, $args);
            $uuid = $args['uuid'];
            $allPostPutVars = $request->getParsedBody();
            return $barController->update($uuid, $allPostPutVars);
        });

        // delete
        $app->delete('/{uuid}', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $barController = new BarController($request, $response, $args);
            $uuid = $args['uuid'];
            return $barController->delete($uuid);
        });

    }); // end of /1.0/bar
    
    $app->group('/foo', function () use ($app) {
        // create
        $app->post('', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $fooController = new FooController($request, $response, $args);
            $allPostPutVars = $request->getParsedBody();
            return $fooController->create($allPostPutVars);
        });

        // read all
        $app->get('', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $fooController = new FooController($request, $response, $args);
            return $fooController->getAll();
        });

        // read single
        $app->get('/{uuid}', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $fooController = new FooController($request, $response, $args);
            $uuid = $args['uuid'];
            return $fooController->get($uuid);
        });

        // update
        $app->put('/{uuid}', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $fooController = new FooController($request, $response, $args);
            $uuid = $args['uuid'];
            $allPostPutVars = $request->getParsedBody();
            return $fooController->update($uuid, $allPostPutVars);
        });

        // delete
        $app->delete('/{uuid}', function (\Slim\Http\Request $request, Slim\Http\Response $response, $args) {
            $fooController = new FooController($request, $response, $args);
            $uuid = $args['uuid'];
            return $fooController->delete($uuid);
        });

    }); // end of /1.0/foo
}); // end of 1.0


$app->run();