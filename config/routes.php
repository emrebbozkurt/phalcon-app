<?php

use Phalcon\Mvc\Router;

$router = new Router();
$router->removeExtraSlashes(true);

$router->add('/:controller', [
    'namespace' => 'App\Controllers',
    'controller' => 1
]);

$router->add('/:controller/:action/:params', [
    'namespace' => 'App\Controllers',
    'controller' => 1,
    'action' => 2,
    'params' => 3,
]);

$router->add('/admin', [
    'namespace' => 'App\Controllers\Admin',
    'controller' => 'Index',
    'action' => 'index',
]);

$router->add('/admin/:controller', [
    'namespace' => 'App\Controllers\Admin',
    'controller' => 1
]);

$router->add('/admin/:controller/:action/:params', [
    'namespace' => 'App\Controllers\Admin',
    'controller' => 1,
    'action' => 2,
    'params' => 3,
]);

return $router;