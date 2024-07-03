<?php
namespace Ambax\articleWebsite;
use Ambax\articleWebsite\Repositories\Database;
use Ambax\articleWebsite\Repositories\SQLite;
use Ambax\articleWebsite\Services\RepositoryServices\ArticleRepositoryService;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

return function()
{
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function(): LoggerInterface 
        {
            $logger = new Logger('articleWebsite');
            $logger->pushHandler(new StreamHandler('/storage/logs/articleWebsite.log', Logger::DEBUG));
            return $logger;
        },
        Database::class => new SQLite(),
        ArticleRepositoryService::class => DI\create(
            ArticleRepositoryService::class->constructor(
                DI\get(Database::class),
            )
        )
    ]);
    return $containerBuilder->build();
};