<?php

use Core\Dispatcher;

require '../vendor/autoload.php';
spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $file;
    }
});


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new AltoRouter();
$dispatcher = new Dispatcher();

$router->map('GET', "/", ["controller" => "home", "action" => "index"]);
$router->map('GET', "/articles/[*:slug]", ["controller" => "articles", "action" => "read"]);

$match = $router->match();
if ($match) {
    $dispatcher->dispatch($match['target'], $match["params"]);
} else {
    var_dump("error no matching routes");
    die();
}
