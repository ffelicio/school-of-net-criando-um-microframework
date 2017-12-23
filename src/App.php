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

    protected function resolveController(array $route)
    {
        $controllerAction = explode('@', $route['callback']);
        if (count($controllerAction) !== 2) {
            throw new \Exception('Invalid controller and action');
        }
        $resolver = new Resolver;
        $controller = $resolver->class($controllerAction[0], ['params' => $route['params']]);
        $action = $controllerAction[1];
        return $controller->$action();
    }

    public function run()
    {
        $route = $this->router->run();
        $resolver = new Resolver;
        if (is_string($route['callback'])) {
            $data = $this->resolveController($route);
        } else {
            $data = $resolver->method($route['callback'], ['params' => $route['params']]);
        }
        $this->renderer->setData($data);
        $this->renderer->run();
    }
}