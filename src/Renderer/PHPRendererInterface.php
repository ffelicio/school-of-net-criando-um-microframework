<?php

namespace Microframework\Renderer;

interface PHPRendererInterface
{
    public function setData($data);
    public function run();
}