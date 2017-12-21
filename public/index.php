<?php
require __DIR__ . '/../vendor/autoload.php';
$path_info = $_SERVER['REQUEST_URI'] ?? '/';
$request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$router = new Microframework\Router\Router($path_info, $request_method);

$router->get('/hello/{name}', function($params) {
    return 'Olá ' . $params[1];
});

$result = $router->run();
echo $result['callback']($result['params']);