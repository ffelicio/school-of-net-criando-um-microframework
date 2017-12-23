<?php

$app->get('/', function() {
    return 'bbbbb';
});

$app->get('/hello', function() {
    return 'aaaaa';
});

$app->get('/hello/{name}', function($params) {
    // Se o retorno for um array, devolverá uma string json.
    return $params;
});

$app->get('/teste/{id}', 'Microframework\Controllers\TesteController@teste');

$app->get('/teste2/{id}/nome/{nome}', function($params) {
    $controller = new Microframework\Controllers\TesteController();
    return $controller->teste2($params);
});