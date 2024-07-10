<?php
require 'vendor/autoload.php';
use Ambax\ArticleWebsite\Exceptions\IncorrectInputException;
use Ambax\ArticleWebsite\Exceptions\ShowToUserException;
use Ambax\ArticleWebsite\Response;
use Ambax\ArticleWebsite\RedirectResponse;
use Twig\Environment;
use Twig\Extension\CoreExtension;
use Twig\Loader\FilesystemLoader;
$container = (require 'app/Controllers/DIconfig.php')();
$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader, [
    'cache' => false,
]);
$twig->getExtension(CoreExtension::class)->setTimezone("Europe/Riga");
$dispatcher = FastRoute\SimpleDispatcher(function (FastRoute\RouteCollector $r) {
    $routes = (require 'routes.php');
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
        } catch (IncorrectInputException|ShowToUserException $e) {
            $items = new RedirectResponse('notify', $e->getMessage(), $_SERVER['HTTP_REFERER']);
        }
        if ($items instanceof Response) {
            echo $twig->render(
                $items->getAddress() . '.twig',
                $items->getData()
            );
        }
        if ($items instanceof RedirectResponse) {
            echo $twig->render(
                $items->getAddress() . '.twig',
                $items->getMessage()
            );
        }
        break;
}