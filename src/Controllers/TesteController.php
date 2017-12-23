<?php

namespace Microframework\Controllers;

class TesteController
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function teste()
    {
        $id = (int)($this->params[1]);
        return require(__DIR__ . '/../../resources/teste.phtml');
    }

    public function teste2($params)
    {
        $id = $params[1];
        $nome = $params[3];
        return require(__DIR__ . '/../../resources/teste2.phtml');
    }
}