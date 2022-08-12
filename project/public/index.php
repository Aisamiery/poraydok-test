<?php

use App\Api\Router;

require_once '../vendor/autoload.php';

header('Content-Type: application/json');

$router = new Router();
$router->add('/', static function () {
    echo json_encode(['title' => 'Test work'], JSON_THROW_ON_ERROR);
});

// Задача: Написать функцию поиска второго по встречаемости символа в строке
$router->add('/issue1', static function() {
    $query = $_GET['query'];
    // обработку ошибок опущу, так как к заданию не относится, но в целом здесь стоит провести валидацию
    $collection = [];
    $queryLen = mb_strlen($query);
    for($index = 0; $index < $queryLen; $index++) {
        if (!isset($collection[$query[$index]])) {
            $collection[$query[$index]] = 0;
        }

        $collection[$query[$index]]++;
    }
    arsort($collection);
    $collection = array_values(array_flip($collection));

    echo json_encode(['symbol' => $collection[1]], JSON_THROW_ON_ERROR);
});

// Написать функцию определяющую является ли строка палиндромом
$router->add('/issue2', static function() {
    $word = $_GET['word'];

    $rev = static function ($str){
        $revert = '';
        for ($index = mb_strlen($str); $index>=0; $index--) {
            $revert .= mb_substr($str, $index, 1);
        }
        return $revert;
    };

    echo json_encode(['palindrom' => $word === $rev($word)], JSON_THROW_ON_ERROR);
});

$router->run();