<?php

namespace Microframework\Controllers;

class TesteController
{
    public function teste($id)
    {
        return require(__DIR__ . '/../../resources/teste.phtml');
    }

    public function teste2($params)
    {
        $id = $params[1];
        $nome = $params[3];
        return require(__DIR__ . '/../../resources/teste2.phtml');
    }
}