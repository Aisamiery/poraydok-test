<?php

namespace App\Api;

interface RouterInterface
{
    /**
     * @return void
     */
    public function run(): void;

    /**
     * @param string $path
     * @param callable $handle
     *
     * @return void
     */
    public function add(string $path, callable $handle): void;
}