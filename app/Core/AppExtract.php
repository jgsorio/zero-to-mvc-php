<?php

namespace App\Core;

use Exception;

class AppExtract
{
    private array $uri = [];
    public array $data = [];

    private int $initializeGetParams = 2;

    /**
     * @throws Exception
     */
    public function controller(): self
    {
        $controller = "Home";
        $this->uri = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
        if (isset($this->uri[0]) && $this->uri[0] !== '') {
            $controller = ucfirst($this->uri[0]);
        }

        $controller = "App\\Controllers\\" . $controller . "Controller";

        if (!class_exists($controller)) {
            throw new Exception("Controller $controller does not exist");
        }
        $this->data['controller'] = $controller;
        return $this;
    }

    public function method(): self
    {
        $method = "index";
        if (isset($this->uri[1])) {
            $method = strtolower($this->uri[1]);
        }

        if (!method_exists($this->data['controller'], $method)) {
            $method = 'index';
            $this->initializeGetParams = 1;
        }

        $this->data['method'] = $method;
        return $this;
    }

    public function params(): self
    {
        $this->data['params'] = array_slice($this->uri, $this->initializeGetParams, count($this->uri));
        return $this;
    }
}
