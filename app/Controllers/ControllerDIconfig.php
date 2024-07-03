<?php
namespace Ambax\ArticleWebsite;
use Ambax\ArticleWebsite\Repositories\Database;
use Ambax\ArticleWebsite\Repositories\SQLite;
use Ambax\ArticleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use function DI\create;
use function DI\get;

return function()
{
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function(): LoggerInterface 
        {
            $logger = new Logger('articleWebsite');
            $logger->pushHandler(new StreamHandler('storage/Logs/articleWebsite.log', Logger::DEBUG));
            return $logger;
        },
        Database::class => create(SQLite::class),
        ArticleRepositoryService::class =>
            create(ArticleRepositoryService::class)->constructor(
                get(Database::class)
        ),
    ]);
    return $containerBuilder->build();
};