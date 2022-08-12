<?php

namespace App\Api;

use JsonException;

/**
 * Класс роутинга приложения
 */
class Router implements RouterInterface
{
    /**
     * @var array
     */
    protected array $routes = [];

    /**
     * @return void
     * @throws JsonException
     */
    public function run(): void
    {
        // get path
        $path = explode('?', $_SERVER['REQUEST_URI']);
        if (isset($this->routes[$path[0]])) {
            $this->routes[$path[0]]();
            return;
        }

        // 404 handler
        $this->notFoundHandler();
    }

    /**
     * @param string $path
     * @param callable $handle
     *
     * @return void
     */
    public function add(string $path, callable $handle): void
    {
        $this->routes[$path] = $handle;
    }

    /**
     * @return void
     * @throws JsonException
     */
    protected function notFoundHandler(): void
    {
        header('HTTP/1.1 404 Not Found"');
        echo json_encode(['message' => "Такой страницы не существует"], JSON_THROW_ON_ERROR);
    }
}