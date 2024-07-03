<?php
require 'vendor/autoload.php';

use Ambax\articleWebsite\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

$container = (require 'config/container.php')();
$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader, [
    'cache' => false,
]);
$dispatcher = FastRoute\SimpleDispatcher(function (FastRoute\RouteCollector $r) {
    $routes = (require 'config/routes.php');
    foreach ($routes as $route) {
        [$method, $path, $controller] = $route;
        $r->addRoute($method, $path, $controller);
    }
});
// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
[$case, $handler, $vars] = $dispatcher->dispatch($httpMethod, $uri);

switch ($case) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        [$controller, $route] = $handler;
        try {
            $items = ($container->get($controller))->$route(...array_values($vars));
        } catch (Exception $e) {
            //TODO implement behavior
        }
        if ($items instanceof Response) {
            try {
                echo $twig->render(
                    $items->getAddress() . '.twig',
                    $items->getData()
                );
            } catch (LoaderError | RuntimeError | SyntaxError $e) {
                //TODO implement behavior
            }
        }
        break;
}