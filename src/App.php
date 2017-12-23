<?php

namespace Microframework;

use Microframework\Router\Router;
use Microframework\DI\Resolver;
use Microframework\Renderer\PHPRendererInterface;

class App
{
    private $router;
    private $renderer;

    public function __construct()
    {
        $path_info = $_SERVER['REQUEST_URI'] ?? '/';
        $request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $this->router = new Router($path_info, $request_method);
    }

    public function setRenderer(PHPRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function get(string $path, $closure)
    {
        $this->router->get($path, $closure);
    }

    public function post(string $path, $closure)
    {
        $this->router->get($path, $closure);
    }

    public function run()
    {
        $route = $this->router->run();
        $resolver = new Resolver();

        $data = $resolver->method($route['callback'], ['params' => $route['params']]);

        $this->renderer->setData($data);
        $this->renderer->run();
    }
}